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
scopre le pagine automaticamente. Modificare l'array `urls` in
[`pa11yci.config.js`](pa11yci.config.js) ogni volta che vengono aggiunte o
rimosse pagine dal sito.


## Comandi

```bash
# Esegue una scansione completa
npm run pa11y:scan
```


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
