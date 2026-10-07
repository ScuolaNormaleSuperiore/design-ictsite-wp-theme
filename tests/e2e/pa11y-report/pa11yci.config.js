/**
 * Configurazione Pa11y CI per lo scanner di accessibilità.
 *
 * Non c'è scoperta automatica delle pagine, a differenza di html-report e
 * status-report che leggono la pagina mappa del sito: l'elenco è in
 * `buildUrls()`. Il sito da controllare si indica con PA11Y_BASE_URL e le
 * pagine di dettaglio specifiche del proprio sito vanno nel file locale
 * `pa11yci.urls.local.json` (ignorato da git).
 *
 * Uso:
 *   PA11Y_BASE_URL=https://example.org npm run pa11y:scan
 */

'use strict';

const fs = require('fs');
const path = require('path');

function buildTimestamp(date) {
  const pad = (n) => String(n).padStart(2, '0');
  return (
    date.getFullYear() +
    pad(date.getMonth() + 1) +
    pad(date.getDate()) +
    '_' +
    pad(date.getHours()) +
    pad(date.getMinutes())
  );
}

const timestamp = buildTimestamp(new Date());

/**
 * Builds the list of pages to scan.
 *
 * The site to scan comes from the PA11Y_BASE_URL environment variable
 * (default: http://localhost). The paths below are the archive and system
 * pages created by the theme. Detail pages of a specific site (a person,
 * an office, a news item, ...) belong in the optional, git-ignored file
 * `pa11yci.urls.local.json`: a JSON array of paths ("/uffici/xyz/") or of
 * absolute URLs, appended to this list.
 *
 * @return {string[]} Absolute URLs.
 */
function buildUrls() {
  const baseUrl = (process.env.PA11Y_BASE_URL || 'http://localhost').replace(/\/+$/, '');
  const paths = [
    '/',
    '/mappa-sito/',
    '/help-desk-it/',
    '/uffici/',
    '/persone/',
    '/progetti/',
    '/notizie/',
    '/luoghi/',
    '/faq-it/',
    '/accessibilita/',
    '/privacy-it/',
  ];

  const localFile = path.join(__dirname, 'pa11yci.urls.local.json');
  if (fs.existsSync(localFile)) {
    paths.push(...JSON.parse(fs.readFileSync(localFile, 'utf8')));
  }

  return paths.map((item) => (/^https?:\/\//.test(item) ? item : baseUrl + item));
}

module.exports = {
  defaults: {
    standard: 'WCAG2AA',
    runners: ['axe', 'htmlcs'],
    includeWarnings: true,
    includeNotices: true,
    timeout: 30000,
    reporters: [
      'cli',
      [
        'pa11y-ci-reporter-html',
        {
          destination: path.join(__dirname, 'reports', `pa11y_report_${timestamp}`),
          includeZeroIssues: true,
        },
      ],
    ],
  },
  urls: buildUrls(),
};
