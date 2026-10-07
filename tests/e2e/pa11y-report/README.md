# Report di accessibilità (pa11y-ci)

Esegue controlli automatici di accessibilità su un elenco fisso di pagine
usando [Pa11y CI](https://github.com/pa11y/pa11y-ci), combinando i motori
**axe-core** e **HTML_CodeSniffer** rispetto alle **WCAG 2.1 AA**.


## Prerequisiti

- **pa11y-ci**: `npm install --save-dev pa11y-ci`
- **pa11y-ci-reporter-html**: `npm install --save-dev pa11y-ci-reporter-html`

Entrambi devono essere installati con lo stesso scope (entrambi locali,
come sopra), altrimenti il reporter non viene trovato.


## Configurare l'elenco delle pagine

A differenza di `html-report` e `status-report`, questo scanner non
scopre le pagine automaticamente.

- **Sito da controllare**: variabile d'ambiente `PA11Y_BASE_URL`
  (default `http://localhost`).
- **Pagine generiche** (home, archivi, accessibilità, privacy): elenco in
  `buildUrls()` di [`pa11yci.config.js`](pa11yci.config.js).
- **Pagine di dettaglio del proprio sito** (una persona, un ufficio, una
  notizia, ...): file locale `pa11yci.urls.local.json`, ignorato da git, con un
  array JSON di percorsi (`"/uffici/nome/"`) o di URL assoluti.


## Comandi

```bash
# Esegue una scansione completa
PA11Y_BASE_URL=https://example.org npm run pa11y:scan
```

Su Windows (PowerShell): `$env:PA11Y_BASE_URL = "https://example.org"; npm run pa11y:scan`.

Con `pa11y-ci` 5 serve Chrome 154: installarlo con
`npx puppeteer browsers install chrome` oppure indicare un Chrome già presente
con la variabile `PUPPETEER_EXECUTABLE_PATH`.


## Output

Ogni esecuzione crea una nuova cartella con timestamp in `reports/`:

```
reports/pa11y_report_YYYYMMDD_HHMM/
  index.html      — riepilogo globale, con link al report di ogni pagina
  <page>.html     — un report di dettaglio per pagina con tutti i problemi rilevati
```

I risultati vengono anche stampati a console tramite il reporter `cli`
durante l'esecuzione.


## Standard e runner

| Impostazione | Valore |
|---|---|
| Standard | WCAG 2.1 AA (`WCAG2AA`) |
| Runner | `axe` (axe-core) + `htmlcs` (HTML_CodeSniffer) |
| Warning / notice | inclusi (`includeWarnings`, `includeNotices`) |


## Codice di uscita

Pa11y CI termina con codice `2` se viene trovato anche un solo errore,
warning o notice (la `threshold` di default è `0`, cioè tolleranza zero).
Per tollerare un numero fisso di problemi, aggiungere `-T <numero>`
(`--threshold`) allo script `pa11y:scan` in `package.json`.


## Note

- `reports/` è ignorata da git tranne che per `.gitkeep` — ogni scansione
  produce un output nuovo, con timestamp, che non viene committato di
  default. Copiare un report nel controllo di versione manualmente se si
  vuole conservare traccia.
