# AGENTS.md

ChatGPT/Codex-specific entry point.

## Bootstrap
Read `AGENTS/AI_BOOTSTRAP.md` and follow its `Session bootstrap` sequence.


## Codex Notes
- Break large tasks into clear steps and report milestones after each.
- Use local file analysis and shell checks to validate changes before reporting done.
- Preserve decisions and context from earlier turns - do not re-derive what was already agreed.
- When modifying files, show minimal targeted diffs rather than full rewrites when possible.
- Execution environment policy:
  - Try commands in WSL first.
  - If required tools are missing (`php`, `node`), switch quickly to approved Windows fallback (`powershell.exe`) and explicitly report that fallback was used.
- Lint policy:
  - Primary command: `composer run lint:php`.
  - If environment blocks it, use Windows PHP fallback with `vendor/bin/phpcs` and always report lint outcome.
- Pre-edit safety checks:
  - Before significant edits, run `git status --short` and `rg` on relevant call-sites.
  - If unexpected changes are found, stop and ask for confirmation.
- Edit strategy:
  - Prefer `apply_patch` for small/medium edits.
  - For cross-file refactors: replace call-sites first, then remove wrappers/dead code.
- Verification minimum:
  - After each change, run syntax/lint checks and search for orphan references with `rg`.
  - Final report must include what could not be verified (for example missing tools/environment limits).
- Issue tracking discipline:
  - When an issue is resolved, update both `AGENTS/ISSUES_TODO.md` and `AGENTS/ISSUES_RESOLVED.md` in the same task.
- Response format preference:
  - Keep outputs brief, numbered, and findings-first.
  - For URL audits, report only high-impact issues unless explicitly asked for exhaustive findings.
