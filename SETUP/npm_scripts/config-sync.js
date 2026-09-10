/**
 * Propagate the version declared in package.json to the other files that carry it.
 *
 * package.json is updated first by `npm version major|minor|patch|<version>`;
 * this script then keeps style.css and VERSION.txt in sync, so the theme header,
 * the plain-text version file and the npm manifest can never drift apart.
 *
 * Uses the Node standard library only: no external dependency is required.
 */

'use strict'

const fs = require('fs')
const path = require('path')

const repoRoot = path.resolve(__dirname, '..', '..')
const version = require(path.join(repoRoot, 'package.json')).version

/**
 * Replace the first match of `pattern` in a file, and report whether it changed.
 *
 * @param {string} relativePath File path relative to the repository root.
 * @param {RegExp} pattern      Pattern identifying the line to rewrite.
 * @param {string} replacement  Replacement text.
 * @return {boolean} True when the file content changed.
 */
const syncFile = (relativePath, pattern, replacement) => {
	const filePath = path.join(repoRoot, relativePath)

	if (!fs.existsSync(filePath)) {
		throw new Error(`File not found: ${relativePath}`)
	}

	const current = fs.readFileSync(filePath, 'utf8')

	if (!pattern.test(current)) {
		throw new Error(`Pattern ${pattern} not found in ${relativePath}`)
	}

	const updated = current.replace(pattern, replacement)

	if (updated === current) {
		return false
	}

	fs.writeFileSync(filePath, updated)
	return true
}

try {
	const changed = []

	if (syncFile('style.css', /^Version:.*$/m, `Version: ${version}`)) {
		changed.push('style.css')
	}

	if (syncFile('VERSION.txt', /^.*$/m, version)) {
		changed.push('VERSION.txt')
	}

	console.info(
		changed.length > 0
			? `Version ${version} written to: ${changed.join(', ')}`
			: `Version ${version} already in sync.`
	)
} catch (error) {
	console.error(`config-sync failed: ${error.message}`)
	process.exit(1)
}
