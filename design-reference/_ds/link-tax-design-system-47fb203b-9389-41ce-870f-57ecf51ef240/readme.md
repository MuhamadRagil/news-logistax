# Link-tax Design System

**Link-tax** (linktax.id) is a multi-tenant self-service accounting SaaS for Indonesian UMKM (small & medium businesses), by PT Logistax Mitratama Solusi (formerly "LogistaxBooks"). Users manage bookkeeping for one or more PTs (companies): double-entry journals, sales/purchase invoices, inventory (average cost), cash & bank, fixed assets & depreciation, Indonesian taxes (PPN 11%, PPh 23), and financial reports — all in **Bahasa Indonesia**. References: Mekari Jurnal, Xero, Wave. Positioning: serious, trust-first B2B (it holds clients' financial data), but friendly.

## Sources

- GitHub: https://github.com/MuhamadRagil/link-tax (branch `master`) — Laravel 12 + Inertia v2 + Vue 3 + Tailwind v4 + shadcn-vue. Key design files: `resources/css/app.css` (tokens), `tailwind.config.js`, `resources/js/components/ui/*` (shadcn-vue primitives), `resources/js/components/*` (custom components), `resources/js/pages/*` (screens), `design-reference/01–03*.html` (visual-refresh references). Explore the repo directly for deeper fidelity when building new designs.

## Products / surfaces

1. **Client web app** — the accounting product (sidebar shell, dashboard, document lists/forms, reports). → `ui_kits/app/`
2. **Marketing landing page** (`pages/Landing/Index.vue`) — light hero with app mockup, pricing, testimonials. → `ui_kits/landing/`
3. **Admin panel** (`pages/Admin/*`) — internal super-admin; same visual language as the client app. Not recreated separately.

## CONTENT FUNDAMENTALS

- **Language: Bahasa Indonesia everywhere.** Formal-friendly ("Anda", capitalized), never slang in the app. The landing page occasionally uses casual "kamu" ("Semua yang kamu butuhkan").
- **Casing:** Title Case for nav items and page titles ("Faktur Penjualan", "Rekonsiliasi Bank"). Sentence case for descriptions and helper text.
- **Tone:** direct, instructional, reassuring. Descriptions explain the accounting consequence: "Posting otomatis menjurnal Piutang, Pendapatan, dan HPP."
- **Empty states:** noun-first title + one-line invitation: "Belum ada faktur" / "Buat faktur penjualan pertama Anda."
- **Greetings:** time-of-day: "Selamat pagi, {name}".
- **Status labels:** Draft / Diposting / Dibatalkan (draft/posted/void); stock: Habis / Menipis; payment: Lunas.
- **Placeholders:** trailing ellipsis — "Cari nomor atau pelanggan…".
- **No emoji.** Icons are Lucide only.
- **Money:** always `Rp 1.234.567,89` (id-ID, 2 decimals, comma decimal separator). Report style wraps negatives in parentheses. Quantities: max 4 decimals, no forced decimals.
- **Document numbers:** `INV-2026/0089`, `JU/2026/0001` — mono font, often a link.
- **Dates:** id-ID format via `formatDate`; page subtitle pattern "PT Contoh Bisnis · Juli 2026".

## VISUAL FOUNDATIONS

- **Palette:** indigo primary `#4F46E5` on slate neutrals. Canvas `#FAFBFC`, cards white, text `#0F172A`, secondary text `#64748B`, borders `#E5E8EC`. Accent/secondary is indigo-50 `#EEF2FF` with `#4338CA` text. Status: success `#16A34A`, warning `#D97706`, destructive `#DC2626`, info = primary. Dark mode exists (slate darks, indigo-500 primary) but light is the default and the reference.
- **Type:** Plus Jakarta Sans for text; **JetBrains Mono for every number** (KPI values, table amounts, doc numbers, prices, step numbers) with `tabular-nums`. Page titles: 24px extrabold, tracking -0.02em. Section titles: 18px bold. Table headers & KPI labels: 12px medium UPPERCASE tracked. Body: 14px.
- **Radius:** 12px dominant (`--radius`). Cards/tables/alerts `rounded-xl` 12px; buttons/inputs/selects 10px; badges, avatars, pills fully round.
- **Cards:** white, 1px `#E5E8EC` border, `shadow-sm` — flat and quiet. KPI cards: icon chip (36px, `bg-primary/10 text-primary`, radius 8px) + uppercase label, then 24px bold mono value.
- **Shadows:** subtle sm/lg only in-app. The landing page uses indigo glows: `0 4px 12px hsl(primary/0.35)` on CTAs, big soft `0 24px 60px -20px hsl(primary/0.25)` on the hero mockup.
- **Backgrounds:** flat colors, no photos, no textures. Landing hero has one radial indigo blur blob (`bg-primary/10 blur-3xl`). Section alternation via `bg-muted/40` bands. No gradients except white radial blobs inside the solid-indigo CTA band.
- **Buttons:** solid indigo default (hover 90% opacity), outline, secondary (indigo-50), ghost, link, destructive. 36px default height.
- **Badges:** pill-shaped, soft 15%-tint background with solid-color text (success/warning/destructive/info); outline variant for drafts.
- **Tables:** inside rounded-xl card; thead `bg-muted/50` uppercase 12px; rows hover `bg-muted/30`; amounts right-aligned mono.
- **Sidebar:** white, thin `#EAECEF` border, inset variant; collapsible icon-mode; groups are collapsibles with chevron-right that rotates 90° when open; active item indigo-50 bg + `#4338CA` text; locked (plan-gated) items 50% opacity + lock icon.
- **Hover states:** background tint shifts (`hover:bg-accent`, `hover:bg-muted/30`), never color inversion. Landing cards lift `-translate-y-0.5` + indigo shadow + `border-primary/40`.
- **Focus:** 2px ring in primary with 2px offset.
- **Animation:** restrained. 150–200ms transitions; toast slides up + fades (200ms out/150ms in); landing uses staggered reveal `revLoad` 0.6s `cubic-bezier(0.22,1,0.36,1)` translateY(14px)→0, pulsing status dot, slow floating blobs. No bounces.
- **Layout:** page content padding 16px/24px, sections stacked with 24px gap; KPI grid 4-up; max-w-6xl landing containers.
- **Transparency/blur:** essentially none in-app (only alpha tints of tokens); one blur blob on landing hero.
- **Empty state:** rounded-xl card, centered, 40px Lucide icon at 40% opacity, medium title, sm description, optional action.

## ICONOGRAPHY

- **Lucide** exclusively (lucide-vue-next in prod). In these HTML/JSX recreations use `lucide-static` CDN SVGs or the `lucide` UMD build; keep default 2px stroke, sizes 16px (buttons, nav) / 14px / 40px (empty states).
- Icon chips: colored icon on 10%-tint rounded square (KPI cards, feature cards `bg-secondary` 44px).
- **No icon font, no emoji, no hand-drawn SVGs.** The only bespoke SVGs in prod are the brand mark and a static sparkline on the landing hero.
- **Logo:** the real brand mark is the geometric indigo "L" gauge in `assets/apple-touch-icon.png` (180×180, transparent) and `assets/favicon.png` (32×32) — copied from the repo's `public/`. There is **no wordmark lockup file** in the repo: `public/logo.svg` turned out to be the Laravel+Vue starter-kit logo (green Vue chevron + "Laravel" wordmark) and was **removed** so it can't be mistaken for the brand; prod references `/images/link-tax-logo.png`, which is not committed. The brand lockup here is therefore the real mark + **"Link-tax" rendered in type** (Plus Jakarta Sans 800, the "-tax" in indigo) — see `guidelines/brand-logo.html`, `components/navigation/Sidebar.jsx`, and the landing/login screens. Never substitute another company's logo.

## Index

- `styles.css` — global entry; imports everything in `tokens/`.
- `tokens/` — `fonts.css` (CDN webfonts — see caveat), `colors.css`, `typography.css`, `layout.css` (radius/shadow/spacing/base), `components.css` (lt-* component classes).
- `assets/` — favicon.png, apple-touch-icon.png (the real geometric brand mark; no wordmark lockup file — see Logo note).
- `guidelines/` — foundation specimen cards (Design System tab).
- `components/core/` — Button, Badge, Card, Alert, Separator, Skeleton, Avatar.
- `components/forms/` — Input, Label, Checkbox, Select, MoneyInput.
- `components/feedback/` — EmptyState, Toast, Dialog.
- `components/navigation/` — Sidebar (simplified shell), Breadcrumbs, Pagination, Tabs — see note.
- `ui_kits/app/` — client app recreation (Dashboard, Faktur Penjualan list, Login) — interactive index.html.
- `ui_kits/landing/` — marketing landing page recreation.
- `SKILL.md` — agent skill entry point.

### Component inventory notes

Source inventory (shadcn-vue `ui/` + custom): alert, avatar, badge, breadcrumb, button, card, checkbox, collapsible, dialog, dropdown-menu, input, label, native-select, navigation-menu, separator, sheet, sidebar, skeleton, tooltip + custom EmptyState, MoneyInput, Pagination, FlashToast. Interaction-heavy primitives (dropdown-menu, tooltip, sheet, collapsible, navigation-menu) are recreated *within* the UI kits rather than as standalone components; the standalone set covers everything visual. **Intentional additions:** none.

**Caveat:** no font binaries exist in the repo (prod loads from fonts.bunny.net); `tokens/fonts.css` loads the same families (Plus Jakarta Sans, JetBrains Mono) from Google Fonts CDN.
