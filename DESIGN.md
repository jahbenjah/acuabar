---
name: Acua Baja Bar & Mar
description: Photo-led Rosarito restaurant and nightlife site with balanced food, bar, and booking paths.
colors:
  primary: "#56d3df"
  deep-charcoal: "#10191c"
  charcoal-surface: "#172326"
  warm-paper: "#f4f2ec"
  paper-ink: "#142023"
  paper-error: "#8a2c15"
  paper-success: "#075b47"
  muted-copy: "#bec8c8"
  soft-divider: "rgba(232, 241, 238, 0.18)"
  dish-mat: "#e2ddd2"
  hero-surface: "#0c1518"
  feature-surface: "#0b1214"
  field-surface: "#0f191c"
  booking-surface: "#142023"
  footer-surface: "#0a1113"
  dark-button-text: "#0b1719"
  dark-button-hover-text: "#091214"
  aqua-hover: "#9af0f4"
  link-teal: "#148b97"
  section-copy: "#495658"
  placeholder-copy: "#aab8b8"
  field-label: "#e4e9e5"
  hero-copy: "#eef2ef"
  strong-copy: "#f0f3f0"
  hero-hours: "#f5f6f2"
  white: "#ffffff"
  form-error: "#ffb7a5"
  form-success: "#9cf0d1"
  header-scrim: "rgba(12, 19, 21, 0.82)"
  paper-divider: "rgba(20, 32, 35, 0.25)"
  field-outline: "rgba(238, 244, 241, 0.28)"
  white-divider: "rgba(255, 255, 255, 0.15)"
  white-outline: "rgba(255, 255, 255, 0.68)"
  image-shade: "rgba(7, 13, 15, 0.9)"
  hero-shade: "rgba(7, 14, 17, 0.8)"
  hero-shade-soft: "rgba(7, 14, 17, 0.18)"
  hero-shade-low: "rgba(7, 14, 17, 0.58)"
  hero-shade-mobile: "rgba(7, 14, 17, 0.88)"
  hero-shade-mobile-soft: "rgba(7, 14, 17, 0.14)"
typography:
  display:
    fontFamily: "Segoe UI, Arial, sans-serif"
    fontSize: "clamp(48px, 8.3vw, 108px)"
    fontWeight: 750
    lineHeight: 0.98
    letterSpacing: "-0.055em"
  body:
    fontFamily: "Segoe UI, Arial, sans-serif"
    fontSize: "16px"
    fontWeight: 400
    lineHeight: 1.6
  label:
    fontFamily: "Segoe UI, Arial, sans-serif"
    fontSize: "16px"
    fontWeight: 750
    letterSpacing: "0.07em"
  hero-copy:
    fontSize: "clamp(18px, 2vw, 23px)"
  feature-heading:
    fontSize: "clamp(34px, 4.5vw, 58px)"
  event-heading:
    fontSize: "clamp(36px, 4.8vw, 60px)"
  section-heading:
    fontSize: "clamp(38px, 5.4vw, 68px)"
  booking-heading:
    fontSize: "clamp(38px, 5vw, 64px)"
  menu-link:
    fontSize: "clamp(21px, 2.5vw, 30px)"
  mobile-display:
    fontSize: "clamp(48px, 14vw, 74px)"
  body-large:
    fontSize: "18px"
  body-feature:
    fontSize: "17px"
  body-small:
    fontSize: "14px"
  navigation:
    fontSize: "13px"
  navigation-mobile:
    fontSize: "12px"
  symbol:
    fontSize: "22px"
rounded:
  square: "0"
  dot: "50%"
components:
  button-primary:
    backgroundColor: "{colors.primary}"
    textColor: "#0b1719"
    height: "52px"
    padding: "0 24px"
  button-primary-hover:
    backgroundColor: "#9af0f4"
    textColor: "#091214"
  button-secondary:
    backgroundColor: "transparent"
    textColor: "#ffffff"
    rounded: "{rounded.square}"
---

# Design System: Acua Baja Bar & Mar

## Overview

**Creative North Star: "Rosarito After Dark, With Room for the Table"**

The site puts the real venue and its nighttime atmosphere first, while keeping food just as easy to discover. Authentic restaurant, celebration, and dish photography, direct navigation, and clear paths to menus, events, and table requests make it practical for visitors deciding where to spend their time.

Charcoal carries the evening mood; warm off-white gives menu browsing and longer reading a clear change of pace. Aqua is reserved for actions and small moments of emphasis. Controls are confident and simple, and the overall page stays photo-led rather than relying on decorative effects.

**Key Characteristics:**
- Nightlife leads; food remains equally prominent.
- Authentic venue, food, and event photography.
- High-contrast charcoal, warm paper, and restrained aqua.
- Clear, bilingual paths from discovery to a visit.

## Colors

The palette pairs deep charcoal with a warm paper surface and uses bright aqua as the single vivid accent. Supporting colors handle photo overlays, form states, dividers, and the neutral gallery mat.

### Primary
- **Lagoon Aqua** (#56d3df): Primary buttons, active language state, and high-priority text links.

### Neutral
- **Deep Charcoal** (#10191c): Main page background and dark content areas.
- **Charcoal Surface** (#172326): Secondary dark surfaces, including the photo-reel panel.
- **Warm Paper** (#f4f2ec): Menu-reading surface and primary text on dark backgrounds.
- **Muted Sea Glass** (#bec8c8): Secondary copy on dark surfaces.
- **Soft Divider** (rgba(232, 241, 238, 0.18)): Subtle separators on dark panels.
- **Photo Mat** (#e2ddd2): Neutral fallback behind cropped dish photography.
- **Night Overlays** (rgba(7, 14, 17, 0.14–0.88); rgba(7, 13, 15, 0.9)): Image legibility over nighttime venue photography.
- **Paper-surface Copy** (#142023, #495658): Primary and secondary text on warm paper, including contact-form labels, controls, placeholders, and feedback.
- **Paper-surface Feedback** (#8a2c15, #075b47): Error and success text with readable contrast on the light form surface.
- **Utility Colors** (#9af0f4, #148b97, #ffb7a5, #9cf0d1): Hover, paper-surface links, and form feedback on dark surfaces.

## Typography

Segoe UI with Arial and sans-serif fallbacks keeps navigation and controls legible across devices. Display, section, feature, and menu-link sizes follow the responsive clamps in the token scale. Supporting text ranges from 12px navigation labels to 18px section copy; paragraph copy remains at a comfortable 1.6 line-height.

## Layout

The desktop content width tops out at 1240px, with gutters that contract at narrower widths. The hero spans the viewport; the two photo-led Food and Bar & Events panels share a two-column row and stack below 640px. Navigation condenses to a toggle below 900px. Menu links use two columns on wider screens and one on mobile; booking and contact fields follow the same responsive pattern.

## Elevation & Depth

The design is intentionally flat. Contrast comes from charcoal and paper surfaces, full-bleed photography, and dark image overlays that keep type readable; there are no card shadows or decorative glows.

## Shapes

Buttons and form fields use square corners. The small aqua marker beside opening hours is circular. Borders are thin and restrained, separating content without enclosing every section in a card.

## Components

- **Primary button:** Aqua fill, dark text, uppercase label, and a 52px minimum height; hover shifts to a lighter aqua.
- **Secondary button:** Transparent fill with a light outline, used beside the primary hero action.
- **Navigation:** Compact uppercase links on desktop; a toggle opens a stacked, keyboard-operable menu on smaller screens.
- **Forms:** High-contrast labels and square dark inputs, with explicit loading, success, and error feedback.
- **Photo panels:** Large real images with a dark lower overlay, a short heading, and a single clear action. The full-width moments section uses a darkened animated photo background with a pause control and a still image for reduced motion.
- **Dish gallery:** Four cropped food photographs in a four-column row that becomes two columns at tablet and mobile widths; menu links remain directly below.

## Do's and Don'ts

- Do use current, authentic venue and food photography.
- Do keep English and Spanish navigation, content, and forms aligned.
- Do keep menus, booking, address, phone, and daily hours easy to find.
- Do preserve reduced-motion behavior and visible keyboard focus.
- Don't invent event schedules, performers, promotions, prices, or availability.
- Don't bury food beneath nightlife content or turn every section into a card.
