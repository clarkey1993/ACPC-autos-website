# Mobile PageSpeed improvement pass

## Scope and rollout
Prepared from master2b48fde. No site deployment/database migration performed. No wording, stock order, form destinations or original photographs/logo masters changed.

After pulling this commit through the established Cloudways workflow:
1. Run `php artisan cars:generate-image-variants` **without --force** once, from the application directory. This creates missing800px card and240px strip variants and preserves originals/existing variants. Check the command's missing/error summary. It writes image derivatives, not stock records; plan normal disk space/backup precautions. Existing1200px/480px sources safely remain usable before/during generation.
2. Clear cached views if the deployment workflow does not already do so: `php artisan view:clear`.
3. Retest all seven car pages plus homepage in mobile PageSpeed, compare several runs rather than promise a particular score. Check main photo, thumbnails, gallery/lightbox, navigation, English/Spanish and light/dark contrast. No rebuild/new dependency installation needed for these changes.

## Changes
- Six compressed responsive WebP logo derivatives at600/1200/1800 widths, preserving aspect/transparency/artwork and prior logo-hover behavior. At1200w, two distinct logo files total150,346 bytes instead of1,364,412 (~89% lower). Actual browser selection varies with viewport/DPR/cache.
- Car cards and main gallery use existing image variants with actual measured width descriptors. No generation or remote fetch during page requests. Missing/corrupt/non-local variants fall back to existing src behavior.
- Additive800px and240px generation for uploads/backfill; thumbnail strip gets its own responsive selection. Originals are not recompressed.
- Targeted light-mode gold text fix for car price and Back link; hover contrast/dark styling preserved.
- Bootstrap left intact: automatically deferring/purging foundational CSS based on one page risks flashes and broken interactive states. Its unused-CSS warning is lower priority than images.

## Verification
45 Laravel tests passed,168 assertions. Includes true-width variants, smaller originals, missing/corrupt/local vs remote storage, correct public-disk URLs, non-force original/existing-variant preservation, gallery markup, dimensions/bytes, priority/lazy attributes and existing access/security/accessibility tests. Independent code review completed.390px mobile local layout visual check: header/footer branding and menu open/close intact. Synthetic local environment only; never deploy that .env or test storage.

## Baseline: official mobile PageSpeed, November17
Lighthouse13.6.0, emulated Moto G Power, Slow4G; single runs, no CrUX field data.

| Car slug | Performance | FCP | LCP | Speed Index |
|---|---:|---:|---:|---:|
|citroen-berlingo-xtr-15-blue-hdi-shine|74|1.9s|9.2s|2.2s|
|2019-peugeot-208-12-puretech-allure|74|1.8s|9.2s|2.8s|
|2021-peugeot-2008-12-gt-automatic-131-bhp|74|1.8s|8.9s|1.8s|
|2019-fiat-500c-cabriolet-automatic-12-lounge|74|1.8s|8.9s|1.8s|
|citroen-berlingo-12-puretech-feel-m|78|2.0s|5.6s|2.0s|
|range-rover-evoque-20d-mhev-180hp-r-dynamic|74|1.8s|8.7s|1.8s|
|2021-peugeot-2008-12-puretech-style|77|1.8s|5.9s|1.8s|

All: TBT0ms, CLS0, accessibility96, best practices100, SEO100. Estimated image savings1.64–1.78MiB/page; logos dominate. First report main photo is LCP and already eager/high. Fourteen oversized thumbnails contribute roughly284KiB estimated waste. Bootstrap render-blocking estimate~850ms, unused CSS21KiB. These are estimates, not additive guaranteed gains. Responsiveness/layout stability are good in these lab runs; slow main-image arrival under constrained mobile is worth improving. No claim about actual customer times or post-change score until live retesting.
