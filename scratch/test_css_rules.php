<?php
// Let's test injecting the dark card CSS into scratch/dashboard.html
// and verify if all text and elements render with good contrast.

$css = <<<CSS
<style id="test-dark-cards">
/* Dark Canvas */
body.admin,
#wrapper,
.content {
    background-color: #0c0e14 !important;
    color: #e2e8f0;
}

/* Dark Cards & Panels */
.panel,
.panel_s,
.panel-body,
.panel-default,
.card,
.widget,
.todo-panel,
.top_stats_wrapper {
    background-color: #161922 !important;
    border-color: rgba(212, 175, 55, 0.18) !important;
    color: #e2e8f0 !important;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.35) !important;
}

.panel-heading {
    background-color: #0f1118 !important;
    border-top: 3px solid #d4af37 !important;
    border-bottom: 1px solid rgba(212, 175, 55, 0.2) !important;
    color: #f3d36b !important;
}

.panel-footer {
    background-color: #0f1118 !important;
    border-top: 1px solid rgba(212, 175, 55, 0.2) !important;
    color: #cbd5e1 !important;
}

.hr-panel-heading,
.hr-panel-separator {
    border-color: rgba(212, 175, 55, 0.15) !important;
}

/* Top Stats KPI Cards */
.top_stats_wrapper {
    border-left: 4px solid #d4af37 !important;
}
.top_stats_wrapper:hover {
    box-shadow: 0 6px 22px rgba(0, 0, 0, 0.5), 0 0 15px rgba(212, 175, 55, 0.25) !important;
    transform: translateY(-2px);
    border-left-color: #ffd700 !important;
}
.top_stats_wrapper .tw-text-neutral-800,
.top_stats_wrapper .tw-text-neutral-600,
.top_stats_wrapper .text-neutral-600 {
    color: #cbd5e1 !important;
}
.top_stats_wrapper svg {
    color: #d4af37 !important;
}

/* Headings & Text inside dark cards */
.panel h1, .panel h2, .panel h3, .panel h4, .panel h5, .panel h6,
.panel_s h1, .panel_s h2, .panel_s h3, .panel_s h4, .panel_s h5, .panel_s h6,
.widget h1, .widget h2, .widget h3, .widget h4, .widget h5, .widget h6 {
    color: #ffffff !important;
}

.panel_s .tw-text-neutral-800,
.panel_s .tw-text-neutral-700,
.panel_s .tw-text-neutral-600,
.panel-body .tw-text-neutral-800,
.panel-body .tw-text-neutral-700,
.panel-body .tw-text-neutral-600 {
    color: #cbd5e1 !important;
}

.panel_s .tw-text-neutral-900,
.panel-body .tw-text-neutral-900 {
    color: #ffffff !important;
}

/* Tables inside dark cards */
.panel_s .table,
.panel-body .table,
.widget .table {
    color: #e2e8f0 !important;
}
.panel_s .table tbody tr td,
.panel-body .table tbody tr td {
    background-color: transparent !important;
    border-top: 1px solid rgba(255, 255, 255, 0.06) !important;
    color: #e2e8f0 !important;
}
.panel_s .table tbody tr:hover td,
.panel-body .table tbody tr:hover td {
    background-color: rgba(212, 175, 55, 0.08) !important;
}
</style>
CSS;

echo "CSS generated successfully. Length: " . strlen($css) . "\n";

