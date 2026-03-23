# RFC Desiderata

## Purpose

This document collects product ideas that could make the theme significantly more useful for universities and public organizations that run an ICT service supporting both internal and external users.

The current theme already provides a solid editorial and informational base:
- services and service clusters;
- staff, offices, places, projects, news, events;
- FAQs, documentation, search, autocomplete, alerts;
- multilingual support and sitemap generation.

The proposals below focus on evolving the product from a content showcase into a practical ICT support portal.


## 1. Quick Wins

These are relatively contained features with a strong usability payoff and a limited implementation surface.

### 1. Service CTA blocks
- Add structured call-to-action blocks on each service page:
  - `Access the service`
  - `Request activation`
  - `Report a problem`
  - `Read the guide`
  - `Contact the office`
- Why it matters:
  users often know the service they need but do not know the next action to take.
- Expected value:
  lower friction, fewer misrouted requests, more task-oriented service pages.

### 2. Structured service metadata
- Add explicit fields for:
  - target audience;
  - prerequisites;
  - activation time;
  - support channel;
  - required documents;
  - availability or SLA notes.
- Why it matters:
  universities and public bodies need operational clarity, not only descriptive pages.
- Expected value:
  service pages become usable as a real service catalog.

### 3. FAQ, documentation, and service cross-linking
- Strengthen the relationship model between services, FAQs, guides, and attachments.
- Automatically show related FAQs and documentation on service pages.
- Why it matters:
  users should be able to solve common issues without switching between disconnected sections.
- Expected value:
  better self-service and fewer repetitive support requests.

### 4. Targeted alerts
- Extend alerts so they can be targeted by:
  - user type;
  - office or department;
  - site location;
  - service area.
- Why it matters:
  a generic alert system quickly becomes noisy.
- Expected value:
  more relevant communications and better trust in the portal.

### 5. Operational office directory
- Enrich office pages with:
  - supported services;
  - responsibility areas;
  - preferred contact channel;
  - office hours;
  - supported locations.
- Why it matters:
  people often need to know who is responsible before they need deeper documentation.
- Expected value:
  faster routing to the correct support team.


## 2. High-Value Features

These features would provide strong practical value and clearly improve the theme's positioning for ICT support use cases.

### 6. Unified help center
- Create a dedicated "Help Center" experience that aggregates:
  - services;
  - FAQs;
  - documentation;
  - support news;
  - contact and office information.
- Add filters by content type, topic, audience, and urgency.
- Why it matters:
  support portals work best when they reduce navigation complexity.
- Expected value:
  a clearer user journey and better discoverability of support resources.

### 7. Guided troubleshooting wizard
- Add a step-by-step flow starting from common problems, for example:
  - cannot access email;
  - Wi-Fi is not working;
  - VPN does not connect;
  - password expired;
  - teaching platform unavailable.
- Each path should lead to the correct FAQ, guide, office, or ticket channel.
- Why it matters:
  users typically describe problems, not services.
- Expected value:
  major reduction in confusion and support load.

### 8. Service status dashboard
- Add a public dashboard for ICT service health:
  - operational;
  - degraded;
  - unavailable;
  - maintenance in progress.
- Cover typical institutional services such as:
  - email;
  - identity and login;
  - LMS;
  - Wi-Fi;
  - VPN;
  - storage;
  - classroom technology.
- Why it matters:
  during outages, users first need a clear status page.
- Expected value:
  fewer duplicate contacts and better transparency.

### 9. Maintenance and interruptions calendar
- Add a dedicated page for scheduled maintenance, service interruptions, and infrastructure updates.
- Allow categorization by service and audience.
- Why it matters:
  universities and public bodies often need to communicate planned disruptions in advance.
- Expected value:
  improved communication quality and reduced frustration.

### 10. New-user onboarding paths
- Add curated onboarding routes for:
  - new students;
  - new employees;
  - researchers;
  - external collaborators;
  - guest lecturers.
- Each path can include a checklist:
  - account activation;
  - MFA;
  - institutional email;
  - Wi-Fi;
  - VPN;
  - learning platforms;
  - software access.
- Why it matters:
  onboarding is one of the most frequent ICT support scenarios.
- Expected value:
  immediate usefulness for universities and large organizations.

### 11. Ticketing integration layer
- Provide a clean integration model with external support systems instead of building ticketing directly into the theme.
- Examples:
  - configurable "Open ticket" links;
  - prefilled query parameters;
  - service-specific forms;
  - different actions for incidents and requests.
- Why it matters:
  most institutions already use an ITSM or ticketing platform.
- Expected value:
  strong practical adoption without overloading the theme with custom workflow logic.


## 3. Distinctive Features

These features would make the theme stand out as a specialized product for institutional ICT support, not just a generic public-sector website.

### 12. Search by user intent
- Evolve search from content retrieval to support intent:
  - "I need to activate"
  - "I have a problem"
  - "I need instructions"
  - "I need to contact someone"
- Why it matters:
  support users rarely think in terms of content types.
- Expected value:
  stronger task completion and better perceived intelligence of the portal.

### 13. Event and teaching support workflows
- Add support content models or templates for:
  - classroom technology;
  - online exams;
  - hybrid teaching;
  - seminars and conferences;
  - streaming and recording;
  - guest access and temporary credentials.
- Why it matters:
  these are highly recurring scenarios in universities and advanced public institutions.
- Expected value:
  better domain fit and stronger specialization.

### 14. Analytics for support content governance
- Expand existing counters into an internal dashboard showing:
  - most viewed services;
  - most viewed FAQs;
  - searches with no results;
  - most common support topics;
  - content gaps.
- Why it matters:
  support portals improve when editorial work is guided by evidence.
- Expected value:
  continuous optimization of help content.

### 15. Stable service catalog export and API
- Formalize the existing JSON export approach into a stable machine-readable service catalog feed.
- Potential uses:
  - chatbot knowledge sources;
  - intranet widgets;
  - app integration;
  - federated search;
  - external knowledge systems.
- Why it matters:
  institutional ICT information increasingly needs to be reused across channels.
- Expected value:
  makes the theme more future-proof and integration-friendly.


## Suggested Priorities

If the goal is to maximize practical value while keeping scope realistic, the most sensible roadmap is:

1. Quick Wins first:
   service CTA blocks, structured service metadata, stronger cross-linking, targeted alerts.
2. Then High-Value Features:
   unified help center, troubleshooting wizard, service status dashboard.
3. Then Distinctive Features:
   search by intent, academic event support, analytics and structured export.


## Recommended Candidate Features For Product Backlog

If only a few items should move into the official feature set first, these are the strongest candidates:

1. Unified help center
2. Guided troubleshooting wizard
3. Service status dashboard
4. Structured service metadata
5. Ticketing integration layer
6. New-user onboarding paths


## Notes

- These proposals are intentionally aligned with the current architecture of the theme, which already includes custom post types, search, autocomplete, FAQs, documentation, office pages, multilingual support, and JSON export capabilities.
- The most valuable direction is to strengthen task-oriented support flows rather than adding more generic editorial sections.
