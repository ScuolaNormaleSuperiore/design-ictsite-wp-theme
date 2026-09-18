/**
 * Configurazione Pa11y CI per lo scanner di accessibilità.
 *
 * Modificare l'array `urls` qui sotto ogni volta che vengono aggiunte o
 * rimosse pagine dal sito — non c'è scoperta automatica delle pagine, a
 * differenza di html-report e status-report che leggono la pagina mappa
 * del sito.
 *
 * Uso:
 *   npm run pa11y:scan
 */

'use strict';

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
  urls: [
    'https://ict.sns.it/',
    'https://ict.sns.it/mappa-sito/',
    'https://ict.sns.it/help-desk-it/',
    'https://ict.sns.it/gruppi-servizi/didattica-e-formazione/',
    'https://ict.sns.it/servizi/agenda-web-per-studenti-e-docenti/',
    'https://ict.sns.it/uffici/',
    'https://ict.sns.it/uffici/servizio-sistemi-informativi/',
    'https://ict.sns.it/persone/',
    'https://ict.sns.it/persone/michele-fiaschi/',
    'https://ict.sns.it/progetti/',
    'https://ict.sns.it/progetti/design-laboratori-e-centri-di-ricerca/',
    'https://ict.sns.it/notizie/',
    'https://ict.sns.it/notizie/e-online-il-nuovo-portale-it/',
    'https://ict.sns.it/luoghi/',
    'https://ict.sns.it/luoghi/palazzo-del-castelletto/',
    'https://ict.sns.it/faq-it/',
    'https://ict.sns.it/faq-it/come-installare-globalprotect-agent-su-windows/',
    'https://ict.sns.it/welcome-kit/welcome-kit-studenti/',
    'https://ict.sns.it/ricerca-sito/?site_search_nonce_field=7779d130a6&_wp_http_referer=%2Fricerca-sito%2F%3Fsite_search_nonce_field%3D7779d130a6%26search_string%3Daccesso%2Balla%2Bposta&search_string=accesso',
    'https://ict.sns.it/accessibilita/',
    'https://ict.sns.it/privacy-it/'
  ],
};
