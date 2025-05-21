CREATE TABLE IF NOT EXISTS wp_dis_custom_translations (
  id          BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  label       TEXT NOT NULL,
  domain      VARCHAR(100) NOT NULL,
  lang        VARCHAR(4) NOT NULL,
  translation TEXT NOT NULL,
  PRIMARY KEY (id),
  KEY idx_text_domain (domain)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (1, 'ContactsPageSlug', 'DIS_ActivationItems', 'en', 'contacts');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (2, 'ContactsPageSlug', 'DIS_ActivationItems', 'it', 'contatti');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (3, 'ContactsPageTitle', 'DIS_ActivationItems', 'en', 'Contacts');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (4, 'ContactsPageTitle', 'DIS_ActivationItems', 'it', 'Contatti');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (5, 'PrivacyPageSlug', 'DIS_ActivationItems', 'en', 'privacy');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (6, 'PrivacyPageSlug', 'DIS_ActivationItems', 'it', 'privacy-it');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (7, 'PrivacyPageTitle', 'DIS_ActivationItems', 'en', 'Privacy policy ');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (8, 'PrivacyPageTitle', 'DIS_ActivationItems', 'it', 'Privacy policy ');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (9, 'SiteMapPageSlug', 'DIS_ActivationItems', 'en', 'site-map');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (10, 'SiteMapPageSlug', 'DIS_ActivationItems', 'it', 'mappa-sito');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (11, 'SiteMapPageTitle', 'DIS_ActivationItems', 'en', 'Site map');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (12, 'SiteMapPageTitle', 'DIS_ActivationItems', 'it', 'Mappa del sito');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (13, 'NewsletterPageSlug', 'DIS_ActivationItems', 'en', 'newsletter');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (14, 'NewsletterPageSlug', 'DIS_ActivationItems', 'it', 'newsletter-it');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (15, 'NewsletterPageTitle', 'DIS_ActivationItems', 'en', 'Newsletter');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (16, 'NewsletterPageTitle', 'DIS_ActivationItems', 'it', 'Newsletter');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (17, 'AccessibilityPageSlug', 'DIS_ActivationItems', 'en', 'accessibility');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (18, 'AccessibilityPageSlug', 'DIS_ActivationItems', 'it', 'accessibilita');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (19, 'AccessibilityPageTitle', 'DIS_ActivationItems', 'en', 'Accessibility');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (20, 'AccessibilityPageTitle', 'DIS_ActivationItems', 'it', 'Accessibilità');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (21, 'LegalNotesPageSlug', 'DIS_ActivationItems', 'en', 'legal-notes');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (22, 'LegalNotesPageSlug', 'DIS_ActivationItems', 'it', 'note-legali');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (23, 'LegalNotesPageTitle', 'DIS_ActivationItems', 'en', 'Legal notes');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (24, 'LegalNotesPageTitle', 'DIS_ActivationItems', 'it', 'Note legali');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (25, 'SiteSearchPageSlug', 'DIS_ActivationItems', 'en', 'site-search');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (26, 'SiteSearchPageSlug', 'DIS_ActivationItems', 'it', 'ricerca-sito');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (27, 'SiteSearchPageTitle', 'DIS_ActivationItems', 'en', 'Site search');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (28, 'SiteSearchPageTitle', 'DIS_ActivationItems', 'it', 'Ricerca sito');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (29, 'PeoplePageSlug', 'DIS_ActivationItems', 'en', 'people');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (30, 'PeoplePageSlug', 'DIS_ActivationItems', 'it', 'persone');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (31, 'PeoplePageTitle', 'DIS_ActivationItems', 'en', 'People');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (32, 'PeoplePageTitle', 'DIS_ActivationItems', 'it', 'Persone');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (33, 'ServiceClusterPageSlug', 'DIS_ActivationItems', 'en', 'service-clusters');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (34, 'ServiceClusterPageSlug', 'DIS_ActivationItems', 'it', 'gruppi-servizi');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (35, 'ServiceClusterPageTitle', 'DIS_ActivationItems', 'en', 'Service clusters');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (36, 'ServiceClusterPageTitle', 'DIS_ActivationItems', 'it', 'Gruppi di servizi');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (37, 'ServiceItemPageSlug', 'DIS_ActivationItems', 'en', 'services');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (38, 'ServiceItemPageSlug', 'DIS_ActivationItems', 'it', 'servizi');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (39, 'ServiceItemPageTitle', 'DIS_ActivationItems', 'en', 'Services');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (40, 'ServiceItemPageTitle', 'DIS_ActivationItems', 'it', 'Servizi');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (41, 'EventPageSlug', 'DIS_ActivationItems', 'en', 'events');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (42, 'EventPageSlug', 'DIS_ActivationItems', 'it', 'eventi');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (43, 'EventPageTitle', 'DIS_ActivationItems', 'en', 'Events');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (44, 'EventPageTitle', 'DIS_ActivationItems', 'it', 'Eventi');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (45, 'ProjectPageSlug', 'DIS_ActivationItems', 'en', 'projects');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (46, 'ProjectPageSlug', 'DIS_ActivationItems', 'it', 'progetti');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (47, 'ProjectPageTitle', 'DIS_ActivationItems', 'en', 'Projects');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (48, 'ProjectPageTitle', 'DIS_ActivationItems', 'it', 'Progetti');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (49, 'MediaPolicyPageSlug', 'DIS_ActivationItems', 'en', 'media-policy');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (50, 'MediaPolicyPageSlug', 'DIS_ActivationItems', 'it', 'media-policy-it');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (51, 'MediaPolicyPageTitle', 'DIS_ActivationItems', 'en', 'Media policy');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (52, 'MediaPolicyPageTitle', 'DIS_ActivationItems', 'it', 'Media policy');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (53, 'AboutUsPageSlug', 'DIS_ActivationItems', 'en', 'about-us');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (54, 'AboutUsPageSlug', 'DIS_ActivationItems', 'it', 'chi-siamo');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (55, 'AboutUsPageTitle', 'DIS_ActivationItems', 'en', 'About us');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (56, 'AboutUsPageTitle', 'DIS_ActivationItems', 'it', 'Chi siamo');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (57, 'DocumentationPageSlug', 'DIS_ActivationItems', 'en', 'documentation');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (58, 'DocumentationPageSlug', 'DIS_ActivationItems', 'it', 'documentazione');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (59, 'DocumentationPageTitle', 'DIS_ActivationItems', 'en', 'Documentation');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (60, 'DocumentationPageTitle', 'DIS_ActivationItems', 'it', 'Documentazione');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (61, 'ReuseLinkTitle', 'DIS_ActivationItems', 'en', 'Reuse');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (62, 'ReuseLinkTitle', 'DIS_ActivationItems', 'it', 'Riuso');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (65, 'MainHeroTitle', 'DIS_SiteOptionLabel', 'en', 'How can I help you?');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (66, 'MainHeroTitle', 'DIS_SiteOptionLabel', 'it', 'Come posso aiutarti?');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (67, 'MainHeroText', 'DIS_SiteOptionLabel', 'en', 'Platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras. Dictum sit amet justo donec enim diam vulputate ut. Eu nisl nunc mi ipsum faucibus.');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (68, 'MainHeroText', 'DIS_SiteOptionLabel', 'it', 'Platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras. Dictum sit amet justo donec enim diam vulputate ut. Eu nisl nunc mi ipsum faucibus.');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (69, 'MainHeroSearchButtonLabel', 'DIS_SiteOptionLabel', 'en', 'Search');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (70, 'MainHeroSearchButtonLabel', 'DIS_SiteOptionLabel', 'it', 'Cerca');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (71, 'MainHeroLeftButtonLabel', 'DIS_SiteOptionLabel', 'en', 'See all services');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (72, 'MainHeroLeftButtonLabel', 'DIS_SiteOptionLabel', 'it', 'Vedi tutti i servizi');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (73, 'MainHeroRightButtonLabel', 'DIS_SiteOptionLabel', 'en', 'Get IT Support');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (74, 'MainHeroRightButtonLabel', 'DIS_SiteOptionLabel', 'it', 'Ottieni supporto IT');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (75, 'ArticlePageSlug', 'DIS_ActivationItems', 'en', 'articles');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (76, 'ArticlePageSlug', 'DIS_ActivationItems', 'it', 'articoli');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (77, 'ArticlePageTitle', 'DIS_ActivationItems', 'en', 'Articles');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (78, 'ArticlePageTitle', 'DIS_ActivationItems', 'it', 'Articoli');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (79, 'OfficePageSlug', 'DIS_ActivationItems', 'en', 'offices');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (80, 'OfficePageSlug', 'DIS_ActivationItems', 'it', 'uffici');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (81, 'OfficePageTitle', 'DIS_ActivationItems', 'en', 'Offices');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (82, 'OfficePageTitle', 'DIS_ActivationItems', 'it', 'Uffici');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (83, 'PlacePageSlug', 'DIS_ActivationItems', 'en', 'places');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (84, 'PlacePageSlug', 'DIS_ActivationItems', 'it', 'luoghi');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (85, 'PlacePageTitle', 'DIS_ActivationItems', 'en', 'Places');
INSERT INTO wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (86, 'PlacePageTitle', 'DIS_ActivationItems', 'it', 'luoghi');
