#!/usr/bin/env bash
set -euo pipefail

echo "[DIS pre-commit] Running secret scan..." >&2

if ! command -v git >/dev/null 2>&1; then
	exit 0
fi

# Third-party and generated files are excluded from the scan: no project secret is
# ever authored there, and minified bundles/sourcemaps are single very long lines
# that make the generic patterns below match across unrelated content.
is_excluded_path() {
	case "$1" in
		vendor/*|node_modules/*|inc/vendor/*) return 0 ;;
		assets/bootstrap-italia/*|assets/algolia/dis-algolia.*) return 0 ;;
		assets/css/compiled/*) return 0 ;;
		*.min.js|*.min.css|*.map) return 0 ;;
		languages/*.mo) return 0 ;;
	esac
	return 1
}

# Initial commit: compare against the empty tree.
if git rev-parse --verify HEAD >/dev/null 2>&1; then
	base_rev=""
else
	base_rev="$(git hash-object -t tree /dev/null)"
fi

if [ -n "$base_rev" ]; then
	staged_files="$(git diff --cached --name-only --diff-filter=ACMRTUXB "$base_rev")"
else
	staged_files="$(git diff --cached --name-only --diff-filter=ACMRTUXB)"
fi

if [ -z "$staged_files" ]; then
	exit 0
fi

scanned_files=()
skipped_count=0
while IFS= read -r staged_file; do
	if [ -z "$staged_file" ]; then
		continue
	fi
	if is_excluded_path "$staged_file"; then
		skipped_count=$((skipped_count + 1))
		continue
	fi
	scanned_files+=("$staged_file")
done <<< "$staged_files"

if [ "$skipped_count" -gt 0 ]; then
	echo "[DIS pre-commit] Skipped $skipped_count third-party/generated file(s)." >&2
fi

if [ "${#scanned_files[@]}" -eq 0 ]; then
	exit 0
fi

if [ -n "$base_rev" ]; then
	diff_output="$(git diff --cached --unified=0 --no-color --diff-filter=ACMRTUXB "$base_rev" -- "${scanned_files[@]}")"
else
	diff_output="$(git diff --cached --unified=0 --no-color --diff-filter=ACMRTUXB -- "${scanned_files[@]}")"
fi

if [ -z "$diff_output" ]; then
	exit 0
fi

added_lines="$(printf '%s\n' "$diff_output" | awk '
	/^\+\+\+ / { next }
	/^\+/ {
		sub(/^\+/, "", $0)
		print
	}
')"

if [ -z "$added_lines" ]; then
	exit 0
fi

# High-signal secret patterns only (to reduce false positives).
patterns=(
	'-----BEGIN (RSA |EC |DSA |OPENSSH |PGP )?PRIVATE KEY-----'
	'(AKIA|ASIA)[A-Z0-9]{16}'
	'gh[pousr]_[A-Za-z0-9]{36,255}'
	'github_pat_[A-Za-z0-9_]{20,}'
	'xox[baprs]-[A-Za-z0-9-]{10,}'
	'sk-[A-Za-z0-9]{20,}'
	'[A-Za-z][A-Za-z0-9+.-]*://[^[:space:]]+:[^[:space:]]+@[^[:space:]]+'
	'(api[_-]?key|client[_-]?secret|access[_-]?token|refresh[_-]?token|password|passwd|pwd|secret)[[:space:]]*[:=][[:space:]]*["\x27][^"\x27]{8,}["\x27]'
)

found=0
for pattern in "${patterns[@]}"; do
	if printf '%s\n' "$added_lines" | grep -E -i -n "$pattern" >/tmp/alm_secret_scan_matches.$$ 2>/dev/null; then
		if [ "$found" -eq 0 ]; then
			echo "[DIS pre-commit] Potential secret detected in staged changes:" >&2
			found=1
		fi
		cat /tmp/alm_secret_scan_matches.$$ >&2
	fi
	rm -f /tmp/alm_secret_scan_matches.$$ >/dev/null 2>&1 || true

done

if [ "$found" -eq 1 ]; then
	echo >&2
	echo "Commit blocked. Remove secrets or move safe examples outside staged changes." >&2
	echo "If this is a false positive, adjust the pattern list or is_excluded_path() in" >&2
	echo ".githooks/check-staged-secrets.sh." >&2
	exit 1
fi

exit 0
