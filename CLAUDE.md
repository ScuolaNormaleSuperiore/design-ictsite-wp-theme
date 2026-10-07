# CLAUDE.md

Claude Code-specific entry point.


## Session bootstrap
Run this section only once at session start, unless the user explicitly asks to reload AGENTS context.

1. Read `AGENTS/AGENTS_README.md`.
2. Read `AGENTS/PROJECT.md`.
3. Read `AGENTS/ARCHITECTURE.md`.
4. Read `AGENTS/AI_BEHAVIOR.md`.
5. Read `AGENTS/CODING_STANDARDS.md`.
6. Report `Bootstrap completed` and the full list of files read.
7. List the skills available in the current session. Explicitly state whether applicable official WordPress skills are loaded; if they are not, notify the human operator.
8. List the available trigger commands from `AGENTS/AI_BEHAVIOR.md` using the format: `/slug` - Trigger X: brief description.
9. Ask the human operator which project task they want to work on.


## Reload trigger
Re-run the full "Session bootstrap" only when the user explicitly asks, using phrases like:
- "reload agents"
- "re-read AGENTS"
- "refresh AGENTS context"


## Claude Code Notes
- Use plan mode for non-trivial tasks (new features, multi-file refactors, architectural decisions).
- Prefer atomic `Edit` operations over full file rewrites — smaller diffs are easier to review.
- Use `Glob`/`Grep` for directed searches; use the Explore agent for broader codebase discovery.
- Run `composer run lint:php` before finalizing code changes when dependencies are available.
- Keep naming and structure aligned with WordPress conventions.
- When creating commits, follow `AGENTS/GIT_WORKFLOW.md`.
