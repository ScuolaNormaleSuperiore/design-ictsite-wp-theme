CREATE TABLE IF NOT EXISTS wp_dis_custom_translations (
  id          BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  label       TEXT NOT NULL,
  domain      VARCHAR(100) NOT NULL,
  lang        VARCHAR(4) NOT NULL,
  translation TEXT NOT NULL,
  PRIMARY KEY (id),
  KEY idx_text_domain (domain)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (1, 'ContactsPageSlug', 'DIS_ActivationItems', 'en', 'contacts');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (2, 'ContactsPageSlug', 'DIS_ActivationItems', 'it', 'contatti');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (3, 'ContactsPageTitle', 'DIS_ActivationItems', 'en', 'Contacts');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (4, 'ContactsPageTitle', 'DIS_ActivationItems', 'it', 'Contatti');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (5, 'PrivacyPageSlug', 'DIS_ActivationItems', 'en', 'privacy');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (6, 'PrivacyPageSlug', 'DIS_ActivationItems', 'it', 'privacy-it');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (7, 'PrivacyPageTitle', 'DIS_ActivationItems', 'en', 'Privacy policy ');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (8, 'PrivacyPageTitle', 'DIS_ActivationItems', 'it', 'Privacy policy ');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (9, 'SiteMapPageSlug', 'DIS_ActivationItems', 'en', 'site-map');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (10, 'SiteMapPageSlug', 'DIS_ActivationItems', 'it', 'mappa-sito');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (11, 'SiteMapPageTitle', 'DIS_ActivationItems', 'en', 'Site map');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (12, 'SiteMapPageTitle', 'DIS_ActivationItems', 'it', 'Mappa del sito');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (13, 'NewsletterPageSlug', 'DIS_ActivationItems', 'en', 'newsletter');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (14, 'NewsletterPageSlug', 'DIS_ActivationItems', 'it', 'newsletter-it');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (15, 'NewsletterPageTitle', 'DIS_ActivationItems', 'en', 'Newsletter');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (16, 'NewsletterPageTitle', 'DIS_ActivationItems', 'it', 'Newsletter');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (17, 'AccessibilityPageSlug', 'DIS_ActivationItems', 'en', 'accessibility');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (18, 'AccessibilityPageSlug', 'DIS_ActivationItems', 'it', 'accessibilita');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (19, 'AccessibilityPageTitle', 'DIS_ActivationItems', 'en', 'Accessibility');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (20, 'AccessibilityPageTitle', 'DIS_ActivationItems', 'it', 'Accessibilità');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (21, 'LegalNotesPageSlug', 'DIS_ActivationItems', 'en', 'legal-notes');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (22, 'LegalNotesPageSlug', 'DIS_ActivationItems', 'it', 'note-legali');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (23, 'LegalNotesPageTitle', 'DIS_ActivationItems', 'en', 'Legal notes');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (24, 'LegalNotesPageTitle', 'DIS_ActivationItems', 'it', 'Note legali');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (25, 'SiteSearchPageSlug', 'DIS_ActivationItems', 'en', 'site-search');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (26, 'SiteSearchPageSlug', 'DIS_ActivationItems', 'it', 'ricerca-sito');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (27, 'SiteSearchPageTitle', 'DIS_ActivationItems', 'en', 'Site search');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (28, 'SiteSearchPageTitle', 'DIS_ActivationItems', 'it', 'Ricerca sito');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (29, 'PeoplePageSlug', 'DIS_ActivationItems', 'en', 'people');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (30, 'PeoplePageSlug', 'DIS_ActivationItems', 'it', 'persone');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (31, 'PeoplePageTitle', 'DIS_ActivationItems', 'en', 'People');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (32, 'PeoplePageTitle', 'DIS_ActivationItems', 'it', 'Persone');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (33, 'ServiceClusterPageSlug', 'DIS_ActivationItems', 'en', 'service-cluster');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (34, 'ServiceClusterPageSlug', 'DIS_ActivationItems', 'it', 'gruppo-servizi');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (35, 'ServiceClusterPageTitle', 'DIS_ActivationItems', 'en', 'Service cluster');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (36, 'ServiceClusterPageTitle', 'DIS_ActivationItems', 'it', 'Gruppo di servizi');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (37, 'ServiceItemPageSlug', 'DIS_ActivationItems', 'en', 'service');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (38, 'ServiceItemPageSlug', 'DIS_ActivationItems', 'it', 'servizio');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (39, 'ServiceItemPageTitle', 'DIS_ActivationItems', 'en', 'Service');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (40, 'ServiceItemPageTitle', 'DIS_ActivationItems', 'it', 'Servizio');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (41, 'EventPageSlug', 'DIS_ActivationItems', 'en', 'events');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (42, 'EventPageSlug', 'DIS_ActivationItems', 'it', 'eventi');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (43, 'EventPageTitle', 'DIS_ActivationItems', 'en', 'Events');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (44, 'EventPageTitle', 'DIS_ActivationItems', 'it', 'Eventi');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (45, 'ProjectPageSlug', 'DIS_ActivationItems', 'en', 'projects');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (46, 'ProjectPageSlug', 'DIS_ActivationItems', 'it', 'progetti');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (47, 'ProjectPageTitle', 'DIS_ActivationItems', 'en', 'Projects');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (48, 'ProjectPageTitle', 'DIS_ActivationItems', 'it', 'Progetti');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (49, 'MediaPolicyPageSlug', 'DIS_ActivationItems', 'en', 'media-policy');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (50, 'MediaPolicyPageSlug', 'DIS_ActivationItems', 'it', 'media-policy-it');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (51, 'MediaPolicyPageTitle', 'DIS_ActivationItems', 'en', 'Media policy');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (52, 'MediaPolicyPageTitle', 'DIS_ActivationItems', 'it', 'Media policy');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (53, 'AboutUsPageSlug', 'DIS_ActivationItems', 'en', 'about-us');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (54, 'AboutUsPageSlug', 'DIS_ActivationItems', 'it', 'chi-siamo');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (55, 'AboutUsPageTitle', 'DIS_ActivationItems', 'en', 'About us');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (56, 'AboutUsPageTitle', 'DIS_ActivationItems', 'it', 'Chi siamo');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (57, 'DocumentationPageSlug', 'DIS_ActivationItems', 'en', 'documentation');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (58, 'DocumentationPageSlug', 'DIS_ActivationItems', 'it', 'documentazione');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (59, 'DocumentationPageTitle', 'DIS_ActivationItems', 'en', 'Documentation');
INSERT INTO local.wp_dis_custom_translations (id, label, domain, lang, translation) VALUES (60, 'DocumentationPageTitle', 'DIS_ActivationItems', 'it', 'Documentazione');
