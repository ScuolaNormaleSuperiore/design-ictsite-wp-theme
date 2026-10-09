# GIT_WORKFLOW.md

Use these rules only when the task includes branch/commit/PR work.


## Branches

- Base branch: `main`.
- Never commit directly to `main`.
- Branch name format: `<prefix>/<camelCaseName>`.
- Prefixes: `features/`, `bugfix/`, `refactor/`, `docs/`.
- Examples:
  - `features/addSpinoff`
  - `bugfix/fixContactForm`
  - `refactor/centralizeRendering`
  - `docs/updateArchitecture`


## Commits

- **Never commit without explicit user permission.** Always show what would be committed and ask before running `git commit`.
- If the target branch is `main`, say so explicitly and ask for confirmation.
- Commit messages in English.
- Prefer prefixes: `Bug-fix:`, `Refactor:`, `Feature:`, `Docs:`.
- First line under 72 characters.
- Avoid generic messages like `fix` or `update`.
- Do not include unrelated changes in the same commit.

Examples:
- `Feature: Add spinoff content type and archive page`
- `Bug-fix: Fix pagination on the events archive`
- `Refactor: Centralize event date rendering logic`
- `Docs: Update ARCHITECTURE.md after menu refactor`

Commit messages and PR descriptions must stay generic about security work: do not describe
the exploitable details of an unfixed or recently fixed vulnerability.


## AI attribution in commits

- Do NOT include `Co-Authored-By:` trailers that mention AI tools (Claude, ChatGPT, or any other AI assistant) in commit messages.


## Pre-commit checks

- Run `composer run lint:php` when possible.
- Do not commit secrets, API keys, or `.env` files.
- Before every commit, scan staged files for sensitive data (for example: API keys, tokens, passwords, private keys, auth headers, cookies, personal data). If potential sensitive data is found, stop the commit flow, report exactly what was found and where (file/path), and remove, redact, or revoke the data before proceeding. Never commit sensitive data, even with user confirmation.
- Automatic secret scan is enforced by `.githooks/pre-commit`.
- Install once per clone: `git config core.hooksPath .githooks`.
- Manual fallback: `.githooks/check-staged-secrets.sh` (run it directly against the staged changes).


## Pull Requests

- Open PR from feature branch to `main`.
- Write clear title and summary.
- Reference public issues by title or number when applicable. Never copy private backlog contents into a commit or PR.
