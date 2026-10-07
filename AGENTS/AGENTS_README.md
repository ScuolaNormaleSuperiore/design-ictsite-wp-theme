# AGENTS_README.md


## Purpose
This directory provides AI-oriented directives and project context to support development, maintenance, bug fixing, and security hardening.


## Location
This directory is in the theme repository root. References to these documents use
the `AGENTS/<file>.md` path. The file names below are relative to this directory.


## File Map
- `../AGENTS.md` / `../CLAUDE.md`: agent-specific entry points and instructions (Codex/ChatGPT and Claude Code).
- `PROJECT.md`: project description, product scope, main features, roles.
- `ARCHITECTURE.md`: architecture description, main modules, key directories, bootstrap, public hooks/endpoints, data model, technology stack, references.
- `CODING_STANDARDS.md`: coding constraints and quality standards.
- `AI_BEHAVIOR.md`: workflow rules and issue management.
- `DEV/CODE_REVIEW/ISSUES_TODO.md`: active backlog. Private and never committed; created on demand if missing.
- `DEV/CODE_REVIEW/ISSUES_RESOLVED.md`: resolved issue archive. Private and never committed; created on demand if missing. Write-mostly: append to it when an issue is
  closed, but read it only when strictly necessary, and by searching it rather than loading
  it in full (see "Reading policy for the issue files" in `AI_BEHAVIOR.md`).
- `GIT_WORKFLOW.md`: branch, commit, and PR conventions.
