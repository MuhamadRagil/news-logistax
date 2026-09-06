/* @ds-bundle: {"format":4,"namespace":"LinkTaxDesignSystem_47fb20","components":[{"name":"Alert","sourcePath":"components/core/Alert.jsx"},{"name":"Avatar","sourcePath":"components/core/Avatar.jsx"},{"name":"Badge","sourcePath":"components/core/Badge.jsx"},{"name":"Button","sourcePath":"components/core/Button.jsx"},{"name":"Card","sourcePath":"components/core/Card.jsx"},{"name":"CardHeader","sourcePath":"components/core/Card.jsx"},{"name":"CardTitle","sourcePath":"components/core/Card.jsx"},{"name":"CardDescription","sourcePath":"components/core/Card.jsx"},{"name":"CardContent","sourcePath":"components/core/Card.jsx"},{"name":"CardFooter","sourcePath":"components/core/Card.jsx"},{"name":"Icon","sourcePath":"components/core/Icon.jsx"},{"name":"Separator","sourcePath":"components/core/Separator.jsx"},{"name":"Skeleton","sourcePath":"components/core/Skeleton.jsx"},{"name":"Dialog","sourcePath":"components/feedback/Dialog.jsx"},{"name":"EmptyState","sourcePath":"components/feedback/EmptyState.jsx"},{"name":"Toast","sourcePath":"components/feedback/Toast.jsx"},{"name":"Checkbox","sourcePath":"components/forms/Checkbox.jsx"},{"name":"Input","sourcePath":"components/forms/Input.jsx"},{"name":"Label","sourcePath":"components/forms/Label.jsx"},{"name":"MoneyInput","sourcePath":"components/forms/MoneyInput.jsx"},{"name":"Select","sourcePath":"components/forms/Select.jsx"},{"name":"Breadcrumbs","sourcePath":"components/navigation/Breadcrumbs.jsx"},{"name":"Pagination","sourcePath":"components/navigation/Pagination.jsx"},{"name":"Sidebar","sourcePath":"components/navigation/Sidebar.jsx"}],"sourceHashes":{"components/core/Alert.jsx":"059ca912a209","components/core/Avatar.jsx":"14e5c169eeb9","components/core/Badge.jsx":"20be2c77b18f","components/core/Button.jsx":"4e5d912dab07","components/core/Card.jsx":"379ccf66736f","components/core/Icon.jsx":"6e6c414e0743","components/core/Separator.jsx":"d8324f52e2ff","components/core/Skeleton.jsx":"4a26a436c790","components/feedback/Dialog.jsx":"083bfaed9e7b","components/feedback/EmptyState.jsx":"69b440dcba61","components/feedback/Toast.jsx":"607ff88c846b","components/forms/Checkbox.jsx":"f62fcbf0e8d8","components/forms/Input.jsx":"40bc2cb6cf42","components/forms/Label.jsx":"1473906ae37f","components/forms/MoneyInput.jsx":"341813cf6639","components/forms/Select.jsx":"e695e9f8bf50","components/navigation/Breadcrumbs.jsx":"32f06d5f1592","components/navigation/Pagination.jsx":"4ecd1ce30b58","components/navigation/Sidebar.jsx":"867449078b93","ui_kits/app/AppShell.jsx":"9485b1e8d011","ui_kits/app/DashboardScreen.jsx":"cd3f3e179870","ui_kits/app/InvoicesScreen.jsx":"4b19b7c60c96","ui_kits/app/LoginScreen.jsx":"ad191a58f04d","ui_kits/landing/LandingScreen.jsx":"795f32a50c06"},"inlinedExternals":[],"unexposedExports":[{"name":"formatIdr","sourcePath":"components/forms/MoneyInput.jsx"}]} */

(() => {

const __ds_ns = (window.LinkTaxDesignSystem_47fb20 = window.LinkTaxDesignSystem_47fb20 || {});

const __ds_scope = {};

(__ds_ns.__errors = __ds_ns.__errors || []);

// components/core/Avatar.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/**
 * Avatar with initials fallback (ui/avatar + useInitials):
 * indigo-50 circle, bold indigo initials.
 */
function Avatar({
  src,
  name = '',
  size = 32,
  className = '',
  ...rest
}) {
  const initials = name.trim().split(/\s+/).map(w => w[0]).slice(0, 2).join('').toUpperCase();
  return /*#__PURE__*/React.createElement("span", _extends({
    className: `lt-avatar ${className}`,
    style: {
      width: size,
      height: size,
      fontSize: size * 0.4
    }
  }, rest), src ? /*#__PURE__*/React.createElement("img", {
    src: src,
    alt: name
  }) : initials);
}
Object.assign(__ds_scope, { Avatar });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Avatar.jsx", error: String((e && e.message) || e) }); }

// components/core/Badge.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/**
 * Status badge — pill with soft 15%-tint background (badge/index.ts).
 * Status mapping in-app: draft=outline, posted=success, void=destructive.
 */
function Badge({
  variant = 'default',
  className = '',
  children,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("span", _extends({
    className: `lt-badge lt-badge--${variant} ${className}`
  }, rest), children);
}
Object.assign(__ds_scope, { Badge });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Badge.jsx", error: String((e && e.message) || e) }); }

// components/core/Button.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/**
 * Link-tax button — shadcn-vue buttonVariants, values from
 * resources/js/components/ui/button/index.ts.
 */
function Button({
  variant = 'default',
  size = 'default',
  asChild,
  href,
  className = '',
  children,
  ...rest
}) {
  const cls = ['lt-btn', `lt-btn--${variant}`, size !== 'default' ? `lt-btn--${size}` : '', className].filter(Boolean).join(' ');
  if (href) {
    return /*#__PURE__*/React.createElement("a", _extends({
      href: href,
      className: cls
    }, rest), children);
  }
  return /*#__PURE__*/React.createElement("button", _extends({
    type: "button",
    className: cls
  }, rest), children);
}
Object.assign(__ds_scope, { Button });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Button.jsx", error: String((e && e.message) || e) }); }

// components/core/Card.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/** Card family — rounded-xl, 1px border, white, shadow-sm (ui/card). */
function Card({
  className = '',
  children,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("div", _extends({
    className: `lt-card ${className}`
  }, rest), children);
}
function CardHeader({
  className = '',
  children,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("div", _extends({
    className: `lt-card__header ${className}`
  }, rest), children);
}
function CardTitle({
  className = '',
  children,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("h3", _extends({
    className: `lt-card__title ${className}`
  }, rest), children);
}
function CardDescription({
  className = '',
  children,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("p", _extends({
    className: `lt-card__description ${className}`
  }, rest), children);
}
function CardContent({
  className = '',
  children,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("div", _extends({
    className: `lt-card__content ${className}`
  }, rest), children);
}
function CardFooter({
  className = '',
  children,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("div", _extends({
    className: `lt-card__footer ${className}`
  }, rest), children);
}
Object.assign(__ds_scope, { Card, CardHeader, CardTitle, CardDescription, CardContent, CardFooter });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Card.jsx", error: String((e && e.message) || e) }); }

// components/core/Icon.jsx
try { (() => {
/**
 * Lucide icon wrapper (mirrors prod Icon.vue, which wraps lucide-vue-next).
 * Requires the Lucide UMD build on the page:
 *   <script src="https://unpkg.com/lucide@0.462.0/dist/umd/lucide.min.js"></script>
 * name: PascalCase Lucide name, e.g. "FileText".
 */
function Icon({
  name,
  size = 16,
  strokeWidth = 2,
  className = '',
  style
}) {
  const lib = typeof window !== 'undefined' ? window.lucide : null;
  const node = lib && lib.icons ? lib.icons[name] : null;
  const fallback = /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'inline-block',
      width: size,
      height: size,
      ...style
    },
    className: className
  });
  if (!node || !Array.isArray(node)) {
    return fallback;
  }
  // Lucide UMD exposes each icon as a full SVG node [tag, attrs, children]
  // (this build), while older iconNode builds are [[tag, attrs], ...].
  // Normalize to the child-element list either way, and never throw on an
  // unexpected shape — a single bad icon must not blank the whole tree.
  const isFullNode = typeof node[0] === 'string' && node[0].toLowerCase() === 'svg' && Array.isArray(node[2]);
  const kids = isFullNode ? node[2] : node;
  const children = (Array.isArray(kids) ? kids : []).filter(child => Array.isArray(child) && typeof child[0] === 'string').map(([tag, attrs], i) => React.createElement(tag, {
    key: i,
    ...(attrs || {})
  }));
  return /*#__PURE__*/React.createElement("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    width: size,
    height: size,
    viewBox: "0 0 24 24",
    fill: "none",
    stroke: "currentColor",
    strokeWidth: strokeWidth,
    strokeLinecap: "round",
    strokeLinejoin: "round",
    className: className,
    style: style,
    "aria-hidden": "true"
  }, children);
}
Object.assign(__ds_scope, { Icon });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Icon.jsx", error: String((e && e.message) || e) }); }

// components/core/Alert.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const ICONS = {
  info: 'Info',
  success: 'CheckCircle2',
  warning: 'TriangleAlert',
  destructive: 'XCircle'
};

/** Soft-tint alert band (ui/alert): rounded-xl, tinted bg + border. */
function Alert({
  variant = 'info',
  title,
  icon,
  className = '',
  children,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("div", _extends({
    className: `lt-alert lt-alert--${variant} ${className}`,
    role: "alert"
  }, rest), /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon || ICONS[variant],
    size: 18,
    style: {
      flexShrink: 0,
      marginTop: 1
    }
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      flex: 1
    }
  }, title ? /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontWeight: 600
    }
  }, title) : null, /*#__PURE__*/React.createElement("div", {
    style: {
      marginTop: title ? 4 : 0
    }
  }, children)));
}
Object.assign(__ds_scope, { Alert });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Alert.jsx", error: String((e && e.message) || e) }); }

// components/core/Separator.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/** Thin divider (ui/separator). */
function Separator({
  orientation = 'horizontal',
  className = '',
  ...rest
}) {
  return /*#__PURE__*/React.createElement("div", _extends({
    className: `lt-separator ${orientation === 'vertical' ? 'lt-separator--vertical' : ''} ${className}`
  }, rest));
}
Object.assign(__ds_scope, { Separator });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Separator.jsx", error: String((e && e.message) || e) }); }

// components/core/Skeleton.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/** Loading placeholder (ui/skeleton): pulsing muted block. */
function Skeleton({
  width,
  height = 16,
  className = '',
  style,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("div", _extends({
    className: `lt-skeleton ${className}`,
    style: {
      width,
      height,
      ...style
    }
  }, rest));
}
Object.assign(__ds_scope, { Skeleton });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Skeleton.jsx", error: String((e && e.message) || e) }); }

// components/feedback/Dialog.jsx
try { (() => {
/**
 * Modal dialog (ui/dialog): overlay + centered rounded-lg card with
 * close X, title, description, footer.
 */
function Dialog({
  open,
  onClose,
  title,
  description,
  footer,
  children,
  width = 512
}) {
  if (!open) return null;
  return /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'fixed',
      inset: 0,
      zIndex: 50,
      display: 'grid',
      placeItems: 'center',
      background: 'rgb(0 0 0 / 0.8)'
    },
    onClick: onClose
  }, /*#__PURE__*/React.createElement("div", {
    role: "dialog",
    "aria-modal": "true",
    onClick: e => e.stopPropagation(),
    style: {
      position: 'relative',
      width: '100%',
      maxWidth: width,
      display: 'grid',
      gap: 16,
      border: '1px solid var(--border)',
      background: 'var(--background)',
      padding: 24,
      borderRadius: 'var(--radius-lg)',
      boxShadow: 'var(--shadow-lg)'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      gap: 6
    }
  }, title ? /*#__PURE__*/React.createElement("h2", {
    style: {
      margin: 0,
      fontSize: 18,
      fontWeight: 600,
      letterSpacing: '-0.025em'
    }
  }, title) : null, description ? /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, description) : null), children, footer ? /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      justifyContent: 'flex-end',
      gap: 8
    }
  }, footer) : null, /*#__PURE__*/React.createElement(__ds_scope.Button, {
    variant: "ghost",
    size: "icon",
    onClick: onClose,
    "aria-label": "Tutup",
    style: {
      position: 'absolute',
      right: 12,
      top: 12,
      width: 28,
      height: 28
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "X",
    size: 16
  }))));
}
Object.assign(__ds_scope, { Dialog });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/feedback/Dialog.jsx", error: String((e && e.message) || e) }); }

// components/feedback/EmptyState.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/**
 * Standard empty state (EmptyState.vue): rounded-xl card, faded 40px icon,
 * title + description + optional action.
 */
function EmptyState({
  icon = 'Inbox',
  title,
  description,
  children,
  className = '',
  ...rest
}) {
  return /*#__PURE__*/React.createElement("div", _extends({
    className: `lt-card ${className}`,
    style: {
      padding: 48,
      textAlign: 'center',
      color: 'var(--muted-foreground)'
    }
  }, rest), /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon,
    size: 40,
    style: {
      opacity: 0.4,
      marginBottom: 12
    }
  }), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontWeight: 500,
      color: 'var(--foreground)'
    }
  }, title), description ? /*#__PURE__*/React.createElement("p", {
    style: {
      margin: '4px 0 0',
      fontSize: 14
    }
  }, description) : null, children ? /*#__PURE__*/React.createElement("div", {
    style: {
      marginTop: 16
    }
  }, children) : null);
}
Object.assign(__ds_scope, { EmptyState });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/feedback/EmptyState.jsx", error: String((e && e.message) || e) }); }

// components/feedback/Toast.jsx
try { (() => {
/**
 * Flash toast (FlashToast.vue): fixed bottom-right, white card,
 * tinted border, success/error icon. Auto-hides after 4s if onClose given.
 */
function Toast({
  kind = 'success',
  message,
  visible = true,
  onClose
}) {
  React.useEffect(() => {
    if (!visible || !onClose) return;
    const t = setTimeout(onClose, 4000);
    return () => clearTimeout(t);
  }, [visible, onClose]);
  if (!visible) return null;
  const success = kind === 'success';
  return /*#__PURE__*/React.createElement("div", {
    role: "status",
    "aria-live": "polite",
    style: {
      position: 'fixed',
      bottom: 24,
      right: 24,
      zIndex: 50,
      display: 'flex',
      alignItems: 'center',
      gap: 12,
      maxWidth: 384,
      borderRadius: 'var(--radius-lg)',
      padding: 16,
      background: 'var(--background)',
      boxShadow: 'var(--shadow-lg)',
      border: `1px solid ${success ? 'hsl(var(--success-hsl) / 0.4)' : 'hsl(var(--destructive-hsl) / 0.4)'}`
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: success ? 'CheckCircle2' : 'XCircle',
    size: 20,
    style: {
      flexShrink: 0,
      color: success ? 'var(--success)' : 'var(--destructive)'
    }
  }), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontSize: 14,
      color: 'var(--foreground)'
    }
  }, message));
}
Object.assign(__ds_scope, { Toast });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/feedback/Toast.jsx", error: String((e && e.message) || e) }); }

// components/forms/Checkbox.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/** Checkbox (ui/checkbox): 20px, indigo when checked. */
function Checkbox({
  label,
  className = '',
  ...rest
}) {
  if (!label) return /*#__PURE__*/React.createElement("input", _extends({
    type: "checkbox",
    className: `lt-checkbox ${className}`
  }, rest));
  return /*#__PURE__*/React.createElement("label", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 12,
      cursor: 'pointer'
    },
    className: "lt-label"
  }, /*#__PURE__*/React.createElement("input", _extends({
    type: "checkbox",
    className: `lt-checkbox ${className}`
  }, rest)), /*#__PURE__*/React.createElement("span", null, label));
}
Object.assign(__ds_scope, { Checkbox });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Checkbox.jsx", error: String((e && e.message) || e) }); }

// components/forms/Input.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/** Text input (ui/input): 40px, 10px radius, ring focus. */
function Input({
  className = '',
  ...rest
}) {
  return /*#__PURE__*/React.createElement("input", _extends({
    className: `lt-input ${className}`
  }, rest));
}
Object.assign(__ds_scope, { Input });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Input.jsx", error: String((e && e.message) || e) }); }

// components/forms/Label.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/** Form label (ui/label): 14px medium. */
function Label({
  className = '',
  children,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("label", _extends({
    className: `lt-label ${className}`
  }, rest), children);
}
Object.assign(__ds_scope, { Label });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Label.jsx", error: String((e && e.message) || e) }); }

// components/forms/MoneyInput.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const fmt = new Intl.NumberFormat('id-ID', {
  minimumFractionDigits: 2,
  maximumFractionDigits: 2
});

/**
 * IDR money input (MoneyInput.vue): raw decimal while focused,
 * id-ID format (1.234.567,89) on blur. Value is a decimal string ("1234567.89").
 */
function MoneyInput({
  value = '',
  onChange,
  placeholder = '0,00',
  disabled,
  className = '',
  ...rest
}) {
  const [focused, setFocused] = React.useState(false);
  const [inner, setInner] = React.useState(value);
  React.useEffect(() => setInner(value), [value]);
  const display = React.useMemo(() => {
    if (focused) return inner;
    if (inner === '' || inner == null) return '';
    const num = Number.parseFloat(inner);
    return Number.isFinite(num) ? fmt.format(num) : '';
  }, [focused, inner]);
  const handleInput = e => {
    let cleaned = e.target.value.replace(/[^0-9.,]/g, '').replace(/,/g, '.');
    const parts = cleaned.split('.');
    if (parts.length > 1) cleaned = parts.shift() + '.' + parts.join('').slice(0, 2);
    setInner(cleaned);
    if (onChange) onChange(cleaned);
  };
  const handleBlur = () => {
    setFocused(false);
    if (inner === '') return;
    const num = Number.parseFloat(inner);
    const next = Number.isFinite(num) && num !== 0 ? String(num) : '';
    setInner(next);
    if (onChange) onChange(next);
  };
  return /*#__PURE__*/React.createElement("input", _extends({
    type: "text",
    inputMode: "decimal",
    autoComplete: "off",
    "aria-label": "Nominal dalam Rupiah",
    value: display,
    placeholder: placeholder,
    disabled: disabled,
    className: `lt-input lt-input--money ${className}`,
    onFocus: () => setFocused(true),
    onBlur: handleBlur,
    onChange: handleInput
  }, rest));
}

/** "1234567.89" → "Rp 1.234.567,89" (useCurrency.formatIdr) */
function formatIdr(value) {
  const num = typeof value === 'string' ? Number.parseFloat(value) : value ?? 0;
  if (!Number.isFinite(num)) return 'Rp 0,00';
  return `Rp ${fmt.format(num)}`;
}
Object.assign(__ds_scope, { MoneyInput, formatIdr });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/MoneyInput.jsx", error: String((e && e.message) || e) }); }

// components/forms/Select.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/** Native select with chevron (ui/native-select): 36px. */
function Select({
  className = '',
  style,
  children,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("span", {
    className: "lt-select-wrap",
    style: style
  }, /*#__PURE__*/React.createElement("select", _extends({
    className: `lt-select ${className}`
  }, rest), children));
}
Object.assign(__ds_scope, { Select });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Select.jsx", error: String((e && e.message) || e) }); }

// components/navigation/Breadcrumbs.jsx
try { (() => {
/** Breadcrumbs (ui/breadcrumb): muted trail, chevron separators, last item dark. */
function Breadcrumbs({
  items = [],
  className = ''
}) {
  return /*#__PURE__*/React.createElement("nav", {
    "aria-label": "breadcrumb",
    className: className
  }, /*#__PURE__*/React.createElement("ol", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 6,
      margin: 0,
      padding: 0,
      listStyle: 'none',
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, items.map((item, i) => {
    const last = i === items.length - 1;
    return /*#__PURE__*/React.createElement("li", {
      key: i,
      style: {
        display: 'flex',
        alignItems: 'center',
        gap: 6
      }
    }, last ? /*#__PURE__*/React.createElement("span", {
      style: {
        color: 'var(--foreground)',
        fontWeight: 400
      },
      "aria-current": "page"
    }, item.title) : /*#__PURE__*/React.createElement("a", {
      href: item.href || '#',
      style: {
        color: 'inherit'
      }
    }, item.title), !last ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
      name: "ChevronRight",
      size: 14
    }) : null);
  })));
}
Object.assign(__ds_scope, { Breadcrumbs });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/navigation/Breadcrumbs.jsx", error: String((e && e.message) || e) }); }

// components/navigation/Pagination.jsx
try { (() => {
const btn = {
  display: 'inline-flex',
  height: 32,
  minWidth: 32,
  alignItems: 'center',
  justifyContent: 'center',
  padding: '0 8px',
  fontSize: 14,
  borderRadius: 'var(--radius-md)',
  border: '1px solid var(--border)',
  background: 'transparent',
  cursor: 'pointer',
  color: 'var(--foreground)',
  fontFamily: 'var(--font-sans)'
};

/**
 * Pagination (Pagination.vue): "Menampilkan X–Y dari Z data" + arrow/number buttons.
 */
function Pagination({
  page = 1,
  pageCount = 1,
  perPage = 15,
  total = 0,
  onPageChange
}) {
  if (total <= 0) return null;
  const from = (page - 1) * perPage + 1;
  const to = Math.min(page * perPage, total);
  const go = p => onPageChange && onPageChange(Math.min(Math.max(1, p), pageCount));
  const pages = Array.from({
    length: pageCount
  }, (_, i) => i + 1);
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexWrap: 'wrap',
      alignItems: 'center',
      justifyContent: 'space-between',
      gap: 12,
      padding: '0 4px'
    }
  }, /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontSize: 12,
      color: 'var(--muted-foreground)'
    }
  }, "Menampilkan ", /*#__PURE__*/React.createElement("span", {
    style: {
      fontWeight: 500,
      color: 'var(--foreground)'
    }
  }, from), "\u2013", /*#__PURE__*/React.createElement("span", {
    style: {
      fontWeight: 500,
      color: 'var(--foreground)'
    }
  }, to), " dari ", /*#__PURE__*/React.createElement("span", {
    style: {
      fontWeight: 500,
      color: 'var(--foreground)'
    }
  }, total), " data"), pageCount > 1 ? /*#__PURE__*/React.createElement("nav", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 4
    }
  }, /*#__PURE__*/React.createElement("button", {
    style: {
      ...btn,
      opacity: page === 1 ? 0.5 : 1
    },
    disabled: page === 1,
    onClick: () => go(page - 1),
    "aria-label": "Sebelumnya"
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "ChevronLeft",
    size: 16
  })), pages.map(p => /*#__PURE__*/React.createElement("button", {
    key: p,
    onClick: () => go(p),
    style: {
      ...btn,
      ...(p === page ? {
        background: 'var(--primary)',
        borderColor: 'var(--primary)',
        color: 'var(--primary-foreground)'
      } : null)
    }
  }, p)), /*#__PURE__*/React.createElement("button", {
    style: {
      ...btn,
      opacity: page === pageCount ? 0.5 : 1
    },
    disabled: page === pageCount,
    onClick: () => go(page + 1),
    "aria-label": "Berikutnya"
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "ChevronRight",
    size: 16
  }))) : null);
}
Object.assign(__ds_scope, { Pagination });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/navigation/Pagination.jsx", error: String((e && e.message) || e) }); }

// components/navigation/Sidebar.jsx
try { (() => {
/**
 * Simplified Link-tax sidebar shell (AppSidebar.vue + ui/sidebar, inset variant):
 * white bg, thin border, collapsible groups with rotating chevron,
 * active item indigo-50, locked items 50% opacity + lock.
 *
 * groups: [{ label, icon, items: [{ title, icon, href, active?, locked? }] }]
 * A group with no items renders as a flat link (like "Dashboard").
 */
function Sidebar({
  logoSrc,
  groups = [],
  footer,
  width = 256,
  onNavigate,
  style
}) {
  const [open, setOpen] = React.useState(() => new Set(groups.filter(g => g.items && g.items.some(i => i.active)).map(g => g.label)));
  const toggle = label => setOpen(prev => {
    const next = new Set(prev);
    if (next.has(label)) next.delete(label);else next.add(label);
    return next;
  });
  const itemBase = {
    display: 'flex',
    width: '100%',
    alignItems: 'center',
    gap: 8,
    padding: 8,
    height: 32,
    borderRadius: 'var(--radius-md)',
    fontSize: 14,
    color: 'var(--sidebar-foreground)',
    background: 'transparent',
    border: 0,
    cursor: 'pointer',
    textAlign: 'left',
    fontFamily: 'var(--font-sans)',
    textDecoration: 'none',
    boxSizing: 'border-box'
  };
  return /*#__PURE__*/React.createElement("aside", {
    style: {
      width,
      flexShrink: 0,
      display: 'flex',
      flexDirection: 'column',
      height: '100%',
      background: 'var(--sidebar-background)',
      borderRight: '1px solid var(--sidebar-border)',
      ...style
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      padding: 12
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 8
    }
  }, logoSrc ? /*#__PURE__*/React.createElement("img", {
    src: logoSrc,
    alt: "",
    style: {
      height: 26,
      width: 26,
      display: 'block'
    }
  }) : null, /*#__PURE__*/React.createElement("span", {
    style: {
      fontWeight: 800,
      fontSize: 18,
      letterSpacing: '-0.02em',
      color: 'var(--foreground)'
    }
  }, "Link", /*#__PURE__*/React.createElement("span", {
    style: {
      color: 'var(--primary)'
    }
  }, "-tax")))), /*#__PURE__*/React.createElement("nav", {
    style: {
      flex: 1,
      overflowY: 'auto',
      padding: '0 8px 8px',
      display: 'flex',
      flexDirection: 'column',
      gap: 2
    }
  }, groups.map(group => {
    if (!group.items) {
      return /*#__PURE__*/React.createElement("a", {
        key: group.label,
        href: group.href || '#',
        onClick: e => {
          e.preventDefault();
          onNavigate && onNavigate(group);
        },
        style: {
          ...itemBase,
          ...(group.active ? {
            background: 'var(--sidebar-accent)',
            color: 'var(--sidebar-accent-foreground)',
            fontWeight: 500
          } : null)
        }
      }, group.icon ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
        name: group.icon,
        size: 16
      }) : null, /*#__PURE__*/React.createElement("span", null, group.label));
    }
    const isOpen = open.has(group.label);
    const hasActive = group.items.some(i => i.active);
    return /*#__PURE__*/React.createElement("div", {
      key: group.label
    }, /*#__PURE__*/React.createElement("button", {
      onClick: () => toggle(group.label),
      style: {
        ...itemBase,
        ...(hasActive && !isOpen ? {
          background: 'var(--sidebar-accent)',
          color: 'var(--sidebar-accent-foreground)'
        } : null)
      }
    }, group.icon ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
      name: group.icon,
      size: 16
    }) : null, /*#__PURE__*/React.createElement("span", {
      style: {
        flex: 1
      }
    }, group.label), /*#__PURE__*/React.createElement(__ds_scope.Icon, {
      name: "ChevronRight",
      size: 16,
      style: {
        transition: 'transform .2s',
        transform: isOpen ? 'rotate(90deg)' : 'none'
      }
    })), isOpen ? /*#__PURE__*/React.createElement("div", {
      style: {
        margin: '2px 0 4px 14px',
        paddingLeft: 10,
        borderLeft: '1px solid var(--sidebar-border)',
        display: 'flex',
        flexDirection: 'column',
        gap: 2
      }
    }, group.items.map(item => /*#__PURE__*/React.createElement("a", {
      key: item.title,
      href: item.href || '#',
      title: item.locked ? 'Fitur ini tidak tersedia pada paket Anda. Tingkatkan paket.' : undefined,
      onClick: e => {
        e.preventDefault();
        onNavigate && onNavigate(item);
      },
      style: {
        ...itemBase,
        height: 28,
        fontSize: 13,
        ...(item.active ? {
          background: 'var(--sidebar-accent)',
          color: 'var(--sidebar-accent-foreground)',
          fontWeight: 500
        } : null),
        ...(item.locked ? {
          opacity: 0.5
        } : null)
      }
    }, item.icon ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
      name: item.icon,
      size: 14
    }) : null, /*#__PURE__*/React.createElement("span", {
      style: {
        flex: 1,
        whiteSpace: 'nowrap',
        overflow: 'hidden',
        textOverflow: 'ellipsis'
      }
    }, item.title), item.locked ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
      name: "Lock",
      size: 13
    }) : null))) : null);
  })), footer ? /*#__PURE__*/React.createElement("div", {
    style: {
      borderTop: '1px solid var(--sidebar-border)',
      padding: 8
    }
  }, footer) : null);
}
Object.assign(__ds_scope, { Sidebar });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/navigation/Sidebar.jsx", error: String((e && e.message) || e) }); }

// ui_kits/app/AppShell.jsx
try { (() => {
const DS = window.LinkTaxDesignSystem_47fb20;
const {
  Sidebar,
  Breadcrumbs,
  Avatar,
  Icon
} = DS;

/** Sidebar nav structure — verbatim from AppSidebar.vue. */
function navGroups(active) {
  const item = (title, icon, key, locked) => ({
    title,
    icon,
    key,
    active: active === key,
    locked
  });
  return [{
    label: 'Dashboard',
    icon: 'LayoutGrid',
    key: 'dashboard',
    active: active === 'dashboard'
  }, {
    label: 'Penjualan',
    icon: 'FileText',
    items: [item('Pesanan Penjualan', 'ClipboardList', 'sales-orders'), item('Surat Jalan', 'Truck', 'delivery-notes'), item('Faktur Penjualan', 'FileText', 'invoices'), item('Retur Penjualan', 'Undo2', 'sales-returns'), item('Uang Muka Penjualan', 'HandCoins', 'sales-advances')]
  }, {
    label: 'Pembelian',
    icon: 'ReceiptText',
    items: [item('Faktur Pembelian', 'ReceiptText', 'bills'), item('Retur Pembelian', 'Redo2', 'purchase-returns'), item('Uang Muka Pembelian', 'Coins', 'purchase-advances'), item('Biaya', 'Wallet', 'expenses')]
  }, {
    label: 'Kas & Bank',
    icon: 'Wallet',
    items: [item('Bank Register', 'Landmark', 'bank-accounts'), item('Transfer', 'ArrowLeftRight', 'transfers'), item('Kas Masuk/Keluar', 'Banknote', 'cash-transactions'), item('Penerimaan', 'HandCoins', 'receipts'), item('Pembayaran', 'Coins', 'disbursements'), item('Rekonsiliasi Bank', 'ScrollText', 'bank-reconciliation')]
  }, {
    label: 'Akuntansi',
    icon: 'BookText',
    items: [item('Bagan Akun', 'ListTree', 'accounts'), item('Jurnal Umum', 'BookText', 'journals'), item('Saldo Awal', 'Scale', 'opening-balance'), item('Periode Fiskal', 'CalendarRange', 'fiscal-periods')]
  }, {
    label: 'Master Data',
    icon: 'Contact2',
    items: [item('Pelanggan', 'Contact2', 'customers'), item('Pemasok', 'Truck', 'suppliers'), item('Produk', 'Package', 'products'), item('Persediaan', 'Boxes', 'stock')]
  }, {
    label: 'Produksi & Persediaan',
    icon: 'Hammer',
    items: [item('Resep Produksi (BOM)', 'FlaskConical', 'boms'), item('Transaksi Produksi', 'Hammer', 'productions'), item('Penyesuaian Stok', 'ScrollText', 'stock-adjustments'), item('Pergerakan Stok', 'ArrowLeftRight', 'inventory-movement'), item('Saldo Stok', 'Boxes', 'inventory-balance')]
  }, {
    label: 'Aset Tetap',
    icon: 'Building2',
    items: [item('Kategori Aset', 'Layers', 'fixed-asset-categories'), item('Daftar Aset', 'Building2', 'fixed-assets'), item('Penyusutan', 'CalendarClock', 'depreciation')]
  }, {
    label: 'Pajak',
    icon: 'Percent',
    items: [item('PPh Pasal 23', 'Percent', 'pph23', true)]
  }, {
    label: 'Laporan',
    icon: 'BookOpenText',
    items: [item('Buku Besar', 'BookOpenText', 'general-ledger'), item('Neraca Saldo', 'Sigma', 'trial-balance'), item('Neraca', 'Landmark', 'balance-sheet'), item('Laba Rugi', 'TrendingUp', 'income-statement'), item('Arus Kas', 'Waves', 'cash-flow'), item('Laporan Penjualan', 'TrendingUp', 'report-sales'), item('Laporan Pembelian', 'ReceiptText', 'report-purchases')]
  }, {
    label: 'Langganan',
    icon: 'CreditCard',
    items: [item('Info Langganan', 'CreditCard', 'billing'), item('Riwayat Tagihan', 'Receipt', 'billing-invoices')]
  }, {
    label: 'Perusahaan',
    icon: 'Settings2',
    items: [item('Pengaturan PT', 'Settings2', 'company-settings'), item('Anggota', 'Users', 'company-members'), item('Log Aktivitas', 'History', 'activity-logs')]
  }];
}

/** App shell: white sidebar (inset variant) + top bar with breadcrumbs. */
function AppShell({
  active,
  breadcrumbs,
  onNavigate,
  onLogout,
  children
}) {
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      height: '100vh',
      overflow: 'hidden',
      background: 'var(--background)'
    }
  }, /*#__PURE__*/React.createElement(Sidebar, {
    logoSrc: "../../assets/apple-touch-icon.png",
    groups: navGroups(active),
    onNavigate: item => item.key && onNavigate(item.key),
    footer: /*#__PURE__*/React.createElement("div", {
      style: {
        display: 'flex',
        alignItems: 'center',
        gap: 8,
        padding: 4
      }
    }, /*#__PURE__*/React.createElement(Avatar, {
      name: "Budi Santoso"
    }), /*#__PURE__*/React.createElement("div", {
      style: {
        flex: 1,
        minWidth: 0
      }
    }, /*#__PURE__*/React.createElement("p", {
      style: {
        margin: 0,
        fontSize: 13,
        fontWeight: 600,
        whiteSpace: 'nowrap',
        overflow: 'hidden',
        textOverflow: 'ellipsis'
      }
    }, "Budi Santoso"), /*#__PURE__*/React.createElement("p", {
      style: {
        margin: 0,
        fontSize: 11,
        color: 'var(--muted-foreground)'
      }
    }, "Owner")), /*#__PURE__*/React.createElement("button", {
      className: "lt-btn lt-btn--ghost lt-btn--icon",
      style: {
        width: 28,
        height: 28
      },
      title: "Keluar",
      "aria-label": "Keluar",
      onClick: onLogout
    }, /*#__PURE__*/React.createElement(Icon, {
      name: "LogOut",
      size: 16
    })))
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      flex: 1,
      display: 'flex',
      flexDirection: 'column',
      minWidth: 0
    }
  }, /*#__PURE__*/React.createElement("header", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 12,
      height: 56,
      padding: '0 16px',
      borderBottom: '1px solid var(--sidebar-border)',
      background: 'var(--card)'
    }
  }, /*#__PURE__*/React.createElement("button", {
    className: "lt-btn lt-btn--ghost lt-btn--icon",
    style: {
      width: 28,
      height: 28
    },
    "aria-label": "Toggle sidebar"
  }, /*#__PURE__*/React.createElement(Icon, {
    name: "PanelLeft",
    size: 16
  })), /*#__PURE__*/React.createElement("div", {
    className: "lt-separator lt-separator--vertical",
    style: {
      height: 16
    }
  }), /*#__PURE__*/React.createElement(Breadcrumbs, {
    items: breadcrumbs
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      marginLeft: 'auto',
      display: 'flex',
      alignItems: 'center',
      gap: 8
    }
  }, /*#__PURE__*/React.createElement("span", {
    className: "lt-badge lt-badge--secondary"
  }, "PT Contoh Bisnis"), /*#__PURE__*/React.createElement("button", {
    className: "lt-btn lt-btn--ghost lt-btn--icon",
    "aria-label": "Notifikasi",
    style: {
      position: 'relative'
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: "Bell",
    size: 16
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      position: 'absolute',
      top: 6,
      right: 7,
      width: 7,
      height: 7,
      borderRadius: 999,
      background: 'var(--destructive)'
    }
  })))), /*#__PURE__*/React.createElement("main", {
    style: {
      flex: 1,
      overflowY: 'auto'
    }
  }, children)));
}
Object.assign(window, {
  AppShell,
  navGroups
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/app/AppShell.jsx", error: String((e && e.message) || e) }); }

// ui_kits/app/DashboardScreen.jsx
try { (() => {
const DS2 = window.LinkTaxDesignSystem_47fb20;
const {
  Alert,
  Badge,
  Button,
  EmptyState,
  Icon
} = DS2;
const kpis = [{
  label: 'Kas & Bank',
  icon: 'Banknote',
  value: 'Rp 45.230.000,00'
}, {
  label: 'Piutang',
  icon: 'FileText',
  value: 'Rp 12.500.000,00',
  sub: 'Outstanding'
}, {
  label: 'Hutang',
  icon: 'ReceiptText',
  value: 'Rp 8.750.000,00',
  sub: 'Outstanding'
}, {
  label: 'Revenue Bulan Ini',
  icon: 'Landmark',
  value: 'Rp 89.400.000,00',
  growth: '+12,4% vs bln lalu'
}];
const recentInvoices = [{
  number: 'INV-2026/0089',
  contact: 'CV Maju Jaya',
  date: '08 Jul 2026',
  total: 'Rp 3.200.000,00',
  status: 'posted',
  label: 'Diposting'
}, {
  number: 'INV-2026/0088',
  contact: 'PT Nusantara Logistik',
  date: '07 Jul 2026',
  total: 'Rp 1.850.000,00',
  status: 'draft',
  label: 'Draft'
}, {
  number: 'INV-2026/0087',
  contact: 'Toko Berkah',
  date: '05 Jul 2026',
  total: 'Rp 12.500.000,00',
  status: 'posted',
  label: 'Diposting'
}];
const recentBills = [{
  number: 'BILL-2026/0042',
  contact: 'PT Supplier Utama',
  date: '08 Jul 2026',
  total: 'Rp 5.400.000,00',
  status: 'posted',
  label: 'Diposting'
}, {
  number: 'BILL-2026/0041',
  contact: 'CV Sumber Bahan',
  date: '06 Jul 2026',
  total: 'Rp 2.150.000,00',
  status: 'draft',
  label: 'Draft'
}];
const lowStock = [{
  name: 'Kertas A4 80gsm',
  sku: 'KRT-A4',
  qty: '0',
  min: '10',
  unit: 'rim',
  status: 'habis',
  label: 'Habis'
}, {
  name: 'Tinta Printer Hitam',
  sku: 'TNT-BK',
  qty: '3',
  min: '5',
  unit: 'pcs',
  status: 'menipis',
  label: 'Menipis'
}];
const VARIANT = {
  draft: 'outline',
  posted: 'success',
  void: 'destructive',
  habis: 'destructive',
  menipis: 'warning'
};
function KpiCard({
  k
}) {
  return /*#__PURE__*/React.createElement("div", {
    className: "lt-card",
    style: {
      padding: 20
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 10
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'flex',
      width: 36,
      height: 36,
      alignItems: 'center',
      justifyContent: 'center',
      borderRadius: 'var(--radius-sm)',
      background: 'hsl(var(--primary-hsl) / 0.1)',
      color: 'var(--primary)'
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: k.icon,
    size: 16
  })), /*#__PURE__*/React.createElement("span", {
    style: {
      fontSize: 12,
      fontWeight: 500,
      textTransform: 'uppercase',
      letterSpacing: '0.025em',
      color: 'var(--muted-foreground)'
    }
  }, k.label)), /*#__PURE__*/React.createElement("p", {
    className: "lt-money",
    style: {
      margin: '12px 0 0',
      fontSize: 24,
      fontWeight: 700
    }
  }, k.value), k.sub ? /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontSize: 12,
      color: 'var(--muted-foreground)'
    }
  }, k.sub) : null, k.growth ? /*#__PURE__*/React.createElement("p", {
    style: {
      margin: '2px 0 0',
      display: 'inline-flex',
      alignItems: 'center',
      gap: 4,
      fontSize: 12,
      color: 'var(--success)'
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: "TrendingUp",
    size: 14
  }), " ", k.growth) : null);
}
function DocTable({
  title,
  rows,
  linkLabel,
  onLink
}) {
  return /*#__PURE__*/React.createElement("div", {
    className: "lt-card",
    style: {
      overflow: 'hidden'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between',
      borderBottom: '1px solid var(--border)',
      padding: '12px 16px'
    }
  }, /*#__PURE__*/React.createElement("h2", {
    style: {
      margin: 0,
      fontSize: 15,
      fontWeight: 600
    }
  }, title), /*#__PURE__*/React.createElement("a", {
    href: "#",
    onClick: e => {
      e.preventDefault();
      onLink && onLink();
    },
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 4,
      fontSize: 12
    }
  }, linkLabel, " ", /*#__PURE__*/React.createElement(Icon, {
    name: "ArrowRight",
    size: 14
  }))), /*#__PURE__*/React.createElement("table", {
    className: "lt-table"
  }, /*#__PURE__*/React.createElement("tbody", null, rows.map(r => /*#__PURE__*/React.createElement("tr", {
    key: r.number
  }, /*#__PURE__*/React.createElement("td", null, /*#__PURE__*/React.createElement("a", {
    href: "#",
    className: "docnum",
    onClick: e => e.preventDefault()
  }, r.number), /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'block',
      fontSize: 12,
      color: 'var(--muted-foreground)'
    }
  }, r.contact, " \xB7 ", r.date)), /*#__PURE__*/React.createElement("td", {
    className: "num"
  }, r.total), /*#__PURE__*/React.createElement("td", {
    style: {
      textAlign: 'right'
    }
  }, /*#__PURE__*/React.createElement(Badge, {
    variant: VARIANT[r.status]
  }, r.label)))))));
}
function DashboardScreen({
  onNavigate
}) {
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 24,
      padding: 24
    },
    "data-screen-label": "Dashboard"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexWrap: 'wrap',
      alignItems: 'flex-end',
      justifyContent: 'space-between',
      gap: 12
    }
  }, /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("h1", {
    style: {
      margin: 0,
      fontSize: 24,
      fontWeight: 800,
      letterSpacing: '-0.02em'
    }
  }, "Selamat pagi, Budi"), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: '2px 0 0',
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, "PT Contoh Bisnis \xB7 Kamis, 09 Juli 2026")), /*#__PURE__*/React.createElement(Badge, {
    variant: "info"
  }, "Masa Trial 7 hari lagi")), /*#__PURE__*/React.createElement(Alert, {
    variant: "warning",
    title: "Perhatian Langganan"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexWrap: 'wrap',
      alignItems: 'center',
      justifyContent: 'space-between',
      gap: 12
    }
  }, /*#__PURE__*/React.createElement("span", null, "Masa trial Anda berakhir dalam 7 hari. Pilih paket untuk melanjutkan."), /*#__PURE__*/React.createElement(Button, {
    size: "sm"
  }, "Perpanjang"))), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      gridTemplateColumns: 'repeat(4, 1fr)',
      gap: 16
    }
  }, kpis.map(k => /*#__PURE__*/React.createElement(KpiCard, {
    key: k.label,
    k: k
  }))), /*#__PURE__*/React.createElement("div", {
    className: "lt-card",
    style: {
      padding: 20
    }
  }, /*#__PURE__*/React.createElement("h2", {
    style: {
      margin: '0 0 8px',
      fontSize: 18,
      fontWeight: 700,
      letterSpacing: '-0.01em'
    }
  }, "Tren Revenue 12 Bulan"), /*#__PURE__*/React.createElement("svg", {
    viewBox: "0 0 640 120",
    style: {
      width: '100%',
      height: 120,
      color: 'var(--primary)'
    },
    preserveAspectRatio: "none"
  }, /*#__PURE__*/React.createElement("path", {
    d: "M0,99 L58,87 L116,90 L174,60 L232,69 L290,36 L348,45 L406,24 L464,30 L522,18 L580,22 L640,15 L640,120 L0,120 Z",
    fill: "hsl(var(--primary-hsl) / 0.12)"
  }), /*#__PURE__*/React.createElement("path", {
    d: "M0,99 L58,87 L116,90 L174,60 L232,69 L290,36 L348,45 L406,24 L464,30 L522,18 L580,22 L640,15",
    fill: "none",
    stroke: "currentColor",
    strokeWidth: "2.5",
    strokeLinecap: "round",
    strokeLinejoin: "round"
  }), /*#__PURE__*/React.createElement("circle", {
    cx: "640",
    cy: "15",
    r: "3.5",
    fill: "currentColor"
  }))), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      gridTemplateColumns: '1fr 1fr',
      gap: 16
    }
  }, /*#__PURE__*/React.createElement(DocTable, {
    title: "Faktur Terbaru",
    rows: recentInvoices,
    linkLabel: "Lihat Semua",
    onLink: () => onNavigate('invoices')
  }), /*#__PURE__*/React.createElement(DocTable, {
    title: "Tagihan Terbaru",
    rows: recentBills,
    linkLabel: "Lihat Semua",
    onLink: () => onNavigate('bills')
  })), /*#__PURE__*/React.createElement("div", {
    className: "lt-card",
    style: {
      overflow: 'hidden'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between',
      borderBottom: '1px solid var(--border)',
      padding: '12px 16px'
    }
  }, /*#__PURE__*/React.createElement("h2", {
    style: {
      margin: 0,
      fontSize: 15,
      fontWeight: 600
    }
  }, "Stok Menipis"), /*#__PURE__*/React.createElement("a", {
    href: "#",
    onClick: e => e.preventDefault(),
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 4,
      fontSize: 12
    }
  }, "Lihat Persediaan ", /*#__PURE__*/React.createElement(Icon, {
    name: "ArrowRight",
    size: 14
  }))), /*#__PURE__*/React.createElement("table", {
    className: "lt-table"
  }, /*#__PURE__*/React.createElement("tbody", null, lowStock.map(p => /*#__PURE__*/React.createElement("tr", {
    key: p.sku
  }, /*#__PURE__*/React.createElement("td", null, p.name, " ", /*#__PURE__*/React.createElement("span", {
    style: {
      fontSize: 12,
      color: 'var(--muted-foreground)'
    }
  }, "(", p.sku, ")")), /*#__PURE__*/React.createElement("td", {
    className: "num"
  }, p.qty, /*#__PURE__*/React.createElement("span", {
    style: {
      fontSize: 12,
      color: 'var(--muted-foreground)'
    }
  }, " / ", p.min), " ", p.unit), /*#__PURE__*/React.createElement("td", {
    style: {
      textAlign: 'right'
    }
  }, /*#__PURE__*/React.createElement(Badge, {
    variant: VARIANT[p.status]
  }, p.label))))))));
}
Object.assign(window, {
  DashboardScreen
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/app/DashboardScreen.jsx", error: String((e && e.message) || e) }); }

// ui_kits/app/InvoicesScreen.jsx
try { (() => {
const DS3 = window.LinkTaxDesignSystem_47fb20;
const {
  Badge,
  Button,
  EmptyState,
  Icon,
  Input,
  Select,
  Pagination
} = DS3;
const ALL_INVOICES = [{
  number: 'INV-2026/0089',
  date: '08 Jul 2026',
  contact: 'CV Maju Jaya',
  total: '3.200.000,00',
  status: 'posted',
  label: 'Diposting'
}, {
  number: 'INV-2026/0088',
  date: '07 Jul 2026',
  contact: 'PT Nusantara Logistik',
  total: '1.850.000,00',
  status: 'draft',
  label: 'Draft'
}, {
  number: 'INV-2026/0087',
  date: '05 Jul 2026',
  contact: 'Toko Berkah',
  total: '12.500.000,00',
  status: 'posted',
  label: 'Diposting'
}, {
  number: 'INV-2026/0086',
  date: '03 Jul 2026',
  contact: 'CV Sinar Abadi',
  total: '4.750.000,00',
  status: 'posted',
  label: 'Diposting'
}, {
  number: 'INV-2026/0085',
  date: '01 Jul 2026',
  contact: 'PT Karya Mandiri',
  total: '950.000,00',
  status: 'void',
  label: 'Dibatalkan'
}, {
  number: 'INV-2026/0084',
  date: '28 Jun 2026',
  contact: 'UD Sejahtera',
  total: '7.300.000,00',
  status: 'posted',
  label: 'Diposting'
}, {
  number: 'INV-2026/0083',
  date: '26 Jun 2026',
  contact: 'CV Maju Jaya',
  total: '2.100.000,00',
  status: 'draft',
  label: 'Draft'
}];
const INV_VARIANT = {
  draft: 'outline',
  posted: 'success',
  void: 'destructive'
};
function InvoicesScreen() {
  const [q, setQ] = React.useState('');
  const [status, setStatus] = React.useState('');
  const [page, setPage] = React.useState(1);
  const filtered = ALL_INVOICES.filter(i => (!status || i.status === status) && (!q || i.number.toLowerCase().includes(q.toLowerCase()) || i.contact.toLowerCase().includes(q.toLowerCase())));
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 24,
      padding: 24
    },
    "data-screen-label": "Faktur Penjualan"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexWrap: 'wrap',
      alignItems: 'center',
      justifyContent: 'space-between',
      gap: 16
    }
  }, /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("h1", {
    style: {
      margin: 0,
      fontSize: 24,
      fontWeight: 600,
      letterSpacing: '-0.025em'
    }
  }, "Faktur Penjualan"), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: '2px 0 0',
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, "Faktur ke pelanggan. Posting otomatis menjurnal Piutang, Pendapatan, dan HPP.")), /*#__PURE__*/React.createElement(Button, null, /*#__PURE__*/React.createElement(Icon, {
    name: "Plus"
  }), " Faktur Baru")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexWrap: 'wrap',
      alignItems: 'center',
      gap: 12
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'relative',
      flex: 1,
      maxWidth: 320
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: "Search",
    size: 16,
    style: {
      position: 'absolute',
      left: 10,
      top: '50%',
      transform: 'translateY(-50%)',
      color: 'var(--muted-foreground)',
      pointerEvents: 'none'
    }
  }), /*#__PURE__*/React.createElement(Input, {
    value: q,
    onChange: e => {
      setQ(e.target.value);
      setPage(1);
    },
    placeholder: "Cari nomor atau pelanggan\u2026",
    style: {
      paddingLeft: 36
    }
  })), /*#__PURE__*/React.createElement(Select, {
    value: status,
    onChange: e => {
      setStatus(e.target.value);
      setPage(1);
    },
    style: {
      width: 176
    }
  }, /*#__PURE__*/React.createElement("option", {
    value: ""
  }, "Semua status"), /*#__PURE__*/React.createElement("option", {
    value: "draft"
  }, "Draft"), /*#__PURE__*/React.createElement("option", {
    value: "posted"
  }, "Diposting"), /*#__PURE__*/React.createElement("option", {
    value: "void"
  }, "Dibatalkan"))), filtered.length === 0 ? /*#__PURE__*/React.createElement("div", {
    className: "lt-card",
    style: {
      padding: 32,
      textAlign: 'center',
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, "Tidak ada hasil untuk pencarian/filter ini.") : /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement("div", {
    className: "lt-table-wrap"
  }, /*#__PURE__*/React.createElement("table", {
    className: "lt-table"
  }, /*#__PURE__*/React.createElement("thead", null, /*#__PURE__*/React.createElement("tr", null, /*#__PURE__*/React.createElement("th", null, "Nomor"), /*#__PURE__*/React.createElement("th", null, "Tanggal"), /*#__PURE__*/React.createElement("th", null, "Pelanggan"), /*#__PURE__*/React.createElement("th", {
    style: {
      textAlign: 'right'
    }
  }, "Total"), /*#__PURE__*/React.createElement("th", null, "Status"))), /*#__PURE__*/React.createElement("tbody", null, filtered.map(inv => /*#__PURE__*/React.createElement("tr", {
    key: inv.number
  }, /*#__PURE__*/React.createElement("td", null, /*#__PURE__*/React.createElement("a", {
    href: "#",
    className: "docnum",
    onClick: e => e.preventDefault()
  }, inv.number)), /*#__PURE__*/React.createElement("td", {
    style: {
      color: 'var(--muted-foreground)'
    }
  }, inv.date), /*#__PURE__*/React.createElement("td", null, inv.contact), /*#__PURE__*/React.createElement("td", {
    className: "num"
  }, inv.total), /*#__PURE__*/React.createElement("td", null, /*#__PURE__*/React.createElement(Badge, {
    variant: INV_VARIANT[inv.status]
  }, inv.label))))))), /*#__PURE__*/React.createElement(Pagination, {
    page: page,
    pageCount: 1,
    perPage: 15,
    total: filtered.length,
    onPageChange: setPage
  })));
}
Object.assign(window, {
  InvoicesScreen
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/app/InvoicesScreen.jsx", error: String((e && e.message) || e) }); }

// ui_kits/app/LoginScreen.jsx
try { (() => {
const DS4 = window.LinkTaxDesignSystem_47fb20;
const {
  Button,
  Checkbox,
  Input,
  Label,
  Icon
} = DS4;

/** Login (auth/Login.vue + AuthSimpleLayout.vue). */
function LoginScreen({
  onLogin
}) {
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      minHeight: '100vh',
      flexDirection: 'column',
      alignItems: 'center',
      justifyContent: 'center',
      gap: 24,
      background: 'var(--background)',
      padding: 24
    },
    "data-screen-label": "Masuk"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      width: '100%',
      maxWidth: 384,
      display: 'flex',
      flexDirection: 'column',
      gap: 32
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      alignItems: 'center',
      gap: 16
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 10
    }
  }, /*#__PURE__*/React.createElement("img", {
    src: "../../assets/apple-touch-icon.png",
    alt: "",
    style: {
      height: 40,
      width: 40
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      fontWeight: 800,
      fontSize: 28,
      letterSpacing: '-0.02em',
      color: 'var(--foreground)'
    }
  }, "Link", /*#__PURE__*/React.createElement("span", {
    style: {
      color: 'var(--primary)'
    }
  }, "-tax"))), /*#__PURE__*/React.createElement("div", {
    style: {
      textAlign: 'center',
      display: 'grid',
      gap: 8
    }
  }, /*#__PURE__*/React.createElement("h1", {
    style: {
      margin: 0,
      fontSize: 20,
      fontWeight: 500
    }
  }, "Masuk ke akun Anda"), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, "Masukkan email dan kata sandi untuk melanjutkan."))), /*#__PURE__*/React.createElement("form", {
    onSubmit: e => {
      e.preventDefault();
      onLogin();
    },
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 24
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      gap: 8
    }
  }, /*#__PURE__*/React.createElement(Label, {
    htmlFor: "email"
  }, "Alamat email"), /*#__PURE__*/React.createElement(Input, {
    id: "email",
    type: "email",
    placeholder: "email@example.com",
    defaultValue: "budi@contohbisnis.co.id"
  })), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      gap: 8
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between'
    }
  }, /*#__PURE__*/React.createElement(Label, {
    htmlFor: "password"
  }, "Kata sandi"), /*#__PURE__*/React.createElement("a", {
    href: "#",
    onClick: e => e.preventDefault(),
    style: {
      fontSize: 14
    }
  }, "Lupa kata sandi?")), /*#__PURE__*/React.createElement(Input, {
    id: "password",
    type: "password",
    placeholder: "Kata sandi",
    defaultValue: "rahasia123"
  })), /*#__PURE__*/React.createElement(Checkbox, {
    label: "Ingat saya",
    defaultChecked: true
  }), /*#__PURE__*/React.createElement(Button, {
    type: "submit",
    style: {
      width: '100%',
      marginTop: 8
    }
  }, "Masuk"), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      textAlign: 'center',
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, "Belum punya akun? ", /*#__PURE__*/React.createElement("a", {
    href: "#",
    onClick: e => e.preventDefault()
  }, "Daftar")))));
}
Object.assign(window, {
  LoginScreen
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/app/LoginScreen.jsx", error: String((e && e.message) || e) }); }

// ui_kits/landing/LandingScreen.jsx
try { (() => {
const DSL = window.LinkTaxDesignSystem_47fb20;
const {
  Button,
  Icon
} = DSL;

/** Brand lockup: real mark (assets/apple-touch-icon.png) + "Link-tax" type wordmark. */
function Wordmark({
  mark = 26,
  text = 18
}) {
  return /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 8
    }
  }, /*#__PURE__*/React.createElement("img", {
    src: "../../assets/apple-touch-icon.png",
    alt: "",
    style: {
      height: mark,
      width: mark
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      fontWeight: 800,
      fontSize: text,
      letterSpacing: '-0.02em',
      color: 'var(--foreground)'
    }
  }, "Link", /*#__PURE__*/React.createElement("span", {
    style: {
      color: 'var(--primary)'
    }
  }, "-tax")));
}
const features = [{
  icon: 'BookOpen',
  title: 'Akuntansi Double-Entry',
  desc: 'Jurnal otomatis, buku besar, neraca, laba rugi. Setiap transaksi tercatat akurat.'
}, {
  icon: 'FileText',
  title: 'Faktur & Pembelian',
  desc: 'Buat faktur profesional, kelola hutang piutang, pantau umur piutang real-time.'
}, {
  icon: 'Receipt',
  title: 'PPN & Faktur Pajak',
  desc: 'Hitung PPN otomatis (11%), generate nomor faktur pajak untuk PKP.'
}, {
  icon: 'Package',
  title: 'Manajemen Persediaan',
  desc: 'Metode average cost, stok real-time, HPP otomatis saat penjualan.'
}, {
  icon: 'Building2',
  title: 'Aset Tetap',
  desc: 'Penyusutan otomatis (garis lurus/saldo menurun), pelepasan aset, nilai buku.'
}, {
  icon: 'BarChart3',
  title: 'Laporan Keuangan',
  desc: 'Neraca, laba rugi, arus kas, buku besar — export PDF & Excel kapan saja.'
}];
const steps = [{
  n: 1,
  title: 'Daftar Gratis',
  desc: 'Buat akun dalam 30 detik.'
}, {
  n: 2,
  title: 'Setup PT & COA',
  desc: 'Masukkan nama PT, mata uang, dan pilih paket.'
}, {
  n: 3,
  title: 'Mulai Pakai',
  desc: 'Buat faktur, catat jurnal, lihat laporan.'
}];
const testimonials = [{
  name: 'Budi Santoso',
  role: 'Owner, CV Maju Jaya',
  text: 'Sebelumnya kami pakai Excel, sekarang semua otomatis. PPN dan faktur pajak langsung ke-generate tanpa ribet.',
  initials: 'BS'
}, {
  name: 'Sari Dewi',
  role: 'Direktur Keuangan, PT Nusantara Logistik',
  text: 'Laporan keuangan yang dulu butuh 3 hari sekarang selesai dalam hitungan menit. Sangat membantu audit tahunan.',
  initials: 'SD'
}, {
  name: 'Ahmad Fauzi',
  role: 'Founder, Toko Online Berkah',
  text: 'Mulai dari UMKM kecil, sekarang sudah 3 entitas terkelola. Harganya sangat terjangkau untuk fitur sebanyak ini.',
  initials: 'AF'
}];
const stats = [{
  value: '500+',
  label: 'Perusahaan'
}, {
  value: '10M+',
  label: 'Transaksi/bln'
}, {
  value: '99.9%',
  label: 'Uptime'
}, {
  value: '4.9/5',
  label: 'Rating user'
}];
const plans = [{
  name: 'Starter',
  desc: 'Untuk UMKM yang baru mulai',
  monthly: 'Rp 99.000,00',
  annual: 'Rp 990.000,00',
  companies: '1',
  users: '2',
  features: ['Akuntansi inti', 'Faktur & pembelian', 'Laporan dasar'],
  popular: false
}, {
  name: 'Bisnis',
  desc: 'Paket paling lengkap untuk bisnis berkembang',
  monthly: 'Rp 249.000,00',
  annual: 'Rp 2.490.000,00',
  companies: '3',
  users: '10',
  features: ['Semua fitur Starter', 'Persediaan & produksi', 'PPh 23 & laporan lanjutan'],
  popular: true
}, {
  name: 'Pro',
  desc: 'Untuk grup usaha multi-entitas',
  monthly: 'Rp 499.000,00',
  annual: 'Rp 4.990.000,00',
  companies: 'Tak terbatas',
  users: 'Tak terbatas',
  features: ['Semua fitur Bisnis', 'Aset tetap', 'Dukungan prioritas'],
  popular: false
}];
const kpiMock = [{
  label: 'Kas & Bank',
  value: 'Rp 45.230.000',
  icon: 'Wallet',
  delta: ''
}, {
  label: 'Piutang',
  value: 'Rp 12.500.000',
  icon: 'FileText',
  delta: ''
}, {
  label: 'Revenue Bln Ini',
  value: 'Rp 89.400.000',
  icon: 'TrendingUp',
  delta: '+12,4%'
}];
const h2Style = {
  margin: 0,
  fontSize: 34,
  fontWeight: 800,
  letterSpacing: '-0.02em',
  textAlign: 'center'
};
const sectionPad = {
  maxWidth: 1152,
  margin: '0 auto',
  padding: '80px 24px'
};
function FeatureCard({
  f
}) {
  return /*#__PURE__*/React.createElement("div", {
    className: "lt-card feature-card",
    style: {
      padding: 24,
      boxShadow: 'none'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      width: 44,
      height: 44,
      alignItems: 'center',
      justifyContent: 'center',
      borderRadius: 'var(--radius-md)',
      background: 'var(--secondary)'
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: f.icon,
    size: 24,
    style: {
      color: 'var(--primary)'
    }
  })), /*#__PURE__*/React.createElement("h3", {
    style: {
      margin: '16px 0 0',
      fontSize: 16,
      fontWeight: 600
    }
  }, f.title), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: '6px 0 0',
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, f.desc));
}
function HeroMockup() {
  return /*#__PURE__*/React.createElement("div", {
    className: "rev",
    style: {
      maxWidth: 768,
      margin: '48px auto 0',
      borderRadius: 16,
      border: '1px solid var(--border)',
      background: 'var(--card)',
      padding: 12,
      boxShadow: '0 24px 60px -20px hsl(var(--primary-hsl) / 0.25)',
      animationDelay: '0.38s'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      gap: 6,
      padding: '6px 8px'
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      width: 12,
      height: 12,
      borderRadius: 999,
      background: 'hsl(var(--destructive-hsl) / 0.6)'
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      width: 12,
      height: 12,
      borderRadius: 999,
      background: 'hsl(var(--warning-hsl) / 0.6)'
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      width: 12,
      height: 12,
      borderRadius: 999,
      background: 'hsl(var(--success-hsl) / 0.6)'
    }
  })), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      gap: 12,
      borderRadius: 'var(--radius-lg)',
      background: 'hsl(var(--muted-hsl) / 0.6)',
      padding: 16,
      textAlign: 'left'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between'
    }
  }, /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontSize: 14,
      fontWeight: 700,
      letterSpacing: '-0.01em'
    }
  }, "Dashboard"), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontSize: 11,
      color: 'var(--muted-foreground)'
    }
  }, "PT Contoh Bisnis \xB7 Juli 2026")), /*#__PURE__*/React.createElement("span", {
    className: "lt-badge lt-badge--secondary",
    style: {
      fontSize: 10
    }
  }, "Owner")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      gridTemplateColumns: 'repeat(3, 1fr)',
      gap: 10
    }
  }, kpiMock.map(k => /*#__PURE__*/React.createElement("div", {
    key: k.label,
    className: "lt-card",
    style: {
      padding: 12,
      boxShadow: 'none'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 6
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'flex',
      width: 24,
      height: 24,
      alignItems: 'center',
      justifyContent: 'center',
      borderRadius: 6,
      background: 'hsl(var(--primary-hsl) / 0.1)',
      color: 'var(--primary)'
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: k.icon,
    size: 14
  })), /*#__PURE__*/React.createElement("span", {
    style: {
      fontSize: 9,
      fontWeight: 500,
      textTransform: 'uppercase',
      letterSpacing: '0.025em',
      color: 'var(--muted-foreground)',
      whiteSpace: 'nowrap',
      overflow: 'hidden',
      textOverflow: 'ellipsis'
    }
  }, k.label)), /*#__PURE__*/React.createElement("p", {
    className: "lt-money",
    style: {
      margin: '8px 0 0',
      fontSize: 14,
      fontWeight: 700
    }
  }, k.value), k.delta ? /*#__PURE__*/React.createElement("p", {
    style: {
      margin: '2px 0 0',
      display: 'inline-flex',
      alignItems: 'center',
      gap: 2,
      fontSize: 9,
      fontWeight: 500,
      color: 'var(--success)'
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: "TrendingUp",
    size: 10
  }), " ", k.delta, " vs bln lalu") : null))), /*#__PURE__*/React.createElement("div", {
    className: "lt-card",
    style: {
      padding: 12,
      boxShadow: 'none'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between',
      marginBottom: 4
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      fontSize: 10,
      fontWeight: 600
    }
  }, "Tren Revenue 12 Bulan"), /*#__PURE__*/React.createElement("span", {
    style: {
      fontSize: 9,
      color: 'var(--muted-foreground)'
    }
  }, "2025 \u2013 2026")), /*#__PURE__*/React.createElement("svg", {
    viewBox: "0 0 320 80",
    style: {
      width: '100%',
      height: 80,
      color: 'var(--primary)'
    },
    preserveAspectRatio: "none"
  }, /*#__PURE__*/React.createElement("path", {
    d: "M0,66 L40,58 L80,60 L120,40 L160,46 L200,24 L240,30 L280,16 L320,10 L320,80 L0,80 Z",
    fill: "hsl(var(--primary-hsl) / 0.12)"
  }), /*#__PURE__*/React.createElement("path", {
    d: "M0,66 L40,58 L80,60 L120,40 L160,46 L200,24 L240,30 L280,16 L320,10",
    fill: "none",
    stroke: "currentColor",
    strokeWidth: "2.5",
    strokeLinecap: "round",
    strokeLinejoin: "round"
  }), /*#__PURE__*/React.createElement("circle", {
    cx: "320",
    cy: "10",
    r: "3.5",
    fill: "currentColor"
  })))));
}
function LandingScreen() {
  const [interval_, setInterval_] = React.useState('monthly');
  return /*#__PURE__*/React.createElement("div", {
    style: {
      background: 'var(--background)'
    }
  }, /*#__PURE__*/React.createElement("header", {
    style: {
      position: 'sticky',
      top: 0,
      zIndex: 30,
      borderBottom: '1px solid var(--border)',
      background: 'hsl(0 0% 100% / 0.85)',
      backdropFilter: 'blur(8px)'
    },
    "data-screen-label": "Landing \u2014 Nav"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 1152,
      margin: '0 auto',
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between',
      height: 64,
      padding: '0 24px'
    }
  }, /*#__PURE__*/React.createElement(Wordmark, {
    mark: 28,
    text: 20
  }), /*#__PURE__*/React.createElement("nav", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 24,
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, /*#__PURE__*/React.createElement("a", {
    href: "#fitur",
    style: {
      color: 'inherit'
    }
  }, "Fitur"), /*#__PURE__*/React.createElement("a", {
    href: "#harga",
    style: {
      color: 'inherit'
    }
  }, "Harga"), /*#__PURE__*/React.createElement("a", {
    href: "#testimoni",
    style: {
      color: 'inherit'
    }
  }, "Testimoni")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      gap: 8
    }
  }, /*#__PURE__*/React.createElement(Button, {
    variant: "ghost"
  }, "Masuk"), /*#__PURE__*/React.createElement(Button, null, "Coba Gratis")))), /*#__PURE__*/React.createElement("section", {
    style: {
      position: 'relative',
      overflow: 'hidden'
    },
    "data-screen-label": "Landing \u2014 Hero"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      pointerEvents: 'none',
      position: 'absolute',
      top: -128,
      left: '50%',
      transform: 'translateX(-50%)',
      width: 768,
      height: 384,
      borderRadius: 999,
      background: 'hsl(var(--primary-hsl) / 0.1)',
      filter: 'blur(64px)'
    }
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'relative',
      maxWidth: 896,
      margin: '0 auto',
      padding: '96px 24px',
      textAlign: 'center'
    }
  }, /*#__PURE__*/React.createElement("div", {
    className: "rev",
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 8,
      whiteSpace: 'nowrap',
      borderRadius: 999,
      border: '1px solid var(--border)',
      background: 'var(--card)',
      padding: '6px 16px',
      fontSize: 12.5,
      fontWeight: 700,
      color: 'var(--muted-foreground)',
      boxShadow: 'var(--shadow-sm)'
    }
  }, /*#__PURE__*/React.createElement("span", {
    className: "dot",
    style: {
      width: 7,
      height: 7,
      borderRadius: 999,
      background: 'var(--success)'
    }
  }), "Dipercaya 500+ UMKM Indonesia"), /*#__PURE__*/React.createElement("h1", {
    className: "rev",
    style: {
      margin: '24px 0 0',
      fontSize: 56,
      fontWeight: 800,
      lineHeight: 1.05,
      letterSpacing: '-0.03em',
      animationDelay: '0.08s'
    }
  }, "Akuntansi Bisnis yang ", /*#__PURE__*/React.createElement("span", {
    style: {
      color: 'var(--primary)'
    }
  }, "Mudah & Terintegrasi")), /*#__PURE__*/React.createElement("p", {
    className: "rev",
    style: {
      maxWidth: 672,
      margin: '24px auto 0',
      fontSize: 18,
      color: 'var(--muted-foreground)',
      animationDelay: '0.16s'
    }
  }, "Kelola pembukuan, faktur, pajak PPN, dan aset tetap dalam satu platform. Dirancang untuk bisnis Indonesia \u2014 dari UMKM hingga perusahaan menengah."), /*#__PURE__*/React.createElement("div", {
    className: "rev",
    style: {
      marginTop: 32,
      display: 'flex',
      flexWrap: 'wrap',
      alignItems: 'center',
      justifyContent: 'center',
      gap: 12,
      animationDelay: '0.24s'
    }
  }, /*#__PURE__*/React.createElement(Button, {
    size: "lg",
    style: {
      boxShadow: 'var(--shadow-primary-glow)'
    }
  }, "Coba Gratis 14 Hari"), /*#__PURE__*/React.createElement(Button, {
    size: "lg",
    variant: "outline"
  }, "Lihat Demo \u2192")), /*#__PURE__*/React.createElement("p", {
    className: "rev",
    style: {
      margin: '12px 0 0',
      fontSize: 12,
      color: 'hsl(var(--muted-foreground-hsl) / 0.8)',
      animationDelay: '0.3s'
    }
  }, "Tidak perlu kartu kredit \xB7 Trial 14 hari penuh"), /*#__PURE__*/React.createElement(HeroMockup, null))), /*#__PURE__*/React.createElement("section", {
    style: {
      borderTop: '1px solid var(--border)',
      borderBottom: '1px solid var(--border)',
      background: 'hsl(var(--muted-hsl) / 0.4)'
    },
    "data-screen-label": "Landing \u2014 Stats"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 1152,
      margin: '0 auto',
      display: 'grid',
      gridTemplateColumns: 'repeat(4, 1fr)',
      gap: 24,
      padding: '40px 24px'
    }
  }, stats.map(s => /*#__PURE__*/React.createElement("div", {
    key: s.label,
    style: {
      textAlign: 'center'
    }
  }, /*#__PURE__*/React.createElement("p", {
    className: "lt-money",
    style: {
      margin: 0,
      fontSize: 30,
      fontWeight: 700,
      color: 'var(--primary)'
    }
  }, s.value), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, s.label))))), /*#__PURE__*/React.createElement("section", {
    id: "fitur",
    style: sectionPad,
    "data-screen-label": "Landing \u2014 Fitur"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 672,
      margin: '0 auto'
    }
  }, /*#__PURE__*/React.createElement("h2", {
    style: {
      ...h2Style,
      fontSize: 38
    }
  }, "Semua yang kamu butuhkan, dalam satu platform"), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: '12px 0 0',
      textAlign: 'center',
      color: 'var(--muted-foreground)'
    }
  }, "Dari jurnal harian hingga laporan pajak, semuanya terintegrasi.")), /*#__PURE__*/React.createElement("div", {
    style: {
      marginTop: 48,
      display: 'grid',
      gridTemplateColumns: 'repeat(3, 1fr)',
      gap: 20
    }
  }, features.map(f => /*#__PURE__*/React.createElement(FeatureCard, {
    key: f.title,
    f: f
  })))), /*#__PURE__*/React.createElement("section", {
    style: {
      borderTop: '1px solid var(--border)',
      borderBottom: '1px solid var(--border)',
      background: 'hsl(var(--muted-hsl) / 0.4)'
    },
    "data-screen-label": "Landing \u2014 Cara Kerja"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 1024,
      margin: '0 auto',
      padding: '80px 24px'
    }
  }, /*#__PURE__*/React.createElement("h2", {
    style: h2Style
  }, "Mulai dalam 3 langkah"), /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'relative',
      marginTop: 48,
      display: 'grid',
      gridTemplateColumns: 'repeat(3, 1fr)',
      gap: 32
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'absolute',
      left: 0,
      right: 0,
      top: 24,
      borderTop: '2px dashed hsl(var(--primary-hsl) / 0.3)'
    }
  }), steps.map(s => /*#__PURE__*/React.createElement("div", {
    key: s.n,
    style: {
      position: 'relative',
      textAlign: 'center'
    }
  }, /*#__PURE__*/React.createElement("div", {
    className: "lt-money",
    style: {
      margin: '0 auto',
      display: 'flex',
      width: 48,
      height: 48,
      alignItems: 'center',
      justifyContent: 'center',
      borderRadius: 999,
      background: 'var(--primary)',
      fontSize: 18,
      fontWeight: 700,
      color: '#fff',
      boxShadow: '0 6px 18px hsl(var(--primary-hsl) / 0.3)'
    }
  }, s.n), /*#__PURE__*/React.createElement("h3", {
    style: {
      margin: '16px 0 0',
      fontSize: 16,
      fontWeight: 600
    }
  }, s.title), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: '4px 0 0',
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, s.desc)))))), /*#__PURE__*/React.createElement("section", {
    id: "harga",
    style: sectionPad,
    "data-screen-label": "Landing \u2014 Harga"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 672,
      margin: '0 auto',
      textAlign: 'center'
    }
  }, /*#__PURE__*/React.createElement("h2", {
    style: {
      ...h2Style,
      fontSize: 38
    }
  }, "Harga transparan, tanpa kejutan"), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: '12px 0 0',
      color: 'var(--muted-foreground)'
    }
  }, "Semua paket termasuk trial 14 hari gratis. Tidak perlu kartu kredit."), /*#__PURE__*/React.createElement("div", {
    style: {
      marginTop: 24,
      display: 'inline-flex',
      borderRadius: 'var(--radius-md)',
      border: '1px solid var(--border)',
      background: 'var(--card)',
      padding: 4,
      boxShadow: 'var(--shadow-sm)'
    }
  }, ['monthly', 'annual'].map(k => /*#__PURE__*/React.createElement("button", {
    key: k,
    onClick: () => setInterval_(k),
    className: "lt-btn",
    style: {
      height: 32,
      padding: '0 16px',
      boxShadow: 'none',
      background: interval_ === k ? 'var(--primary)' : 'transparent',
      color: interval_ === k ? '#fff' : 'var(--muted-foreground)'
    }
  }, k === 'monthly' ? 'Bulanan' : 'Tahunan (hemat 2 bln)')))), /*#__PURE__*/React.createElement("div", {
    style: {
      marginTop: 48,
      display: 'grid',
      gridTemplateColumns: 'repeat(3, 1fr)',
      gap: 24
    }
  }, plans.map(plan => /*#__PURE__*/React.createElement("div", {
    key: plan.name,
    className: "lt-card",
    style: {
      position: 'relative',
      display: 'flex',
      flexDirection: 'column',
      padding: 24,
      ...(plan.popular ? {
        transform: 'scale(1.03)',
        boxShadow: '0 18px 44px -16px hsl(var(--primary-hsl) / 0.35)',
        border: '2px solid var(--primary)'
      } : null)
    }
  }, plan.popular ? /*#__PURE__*/React.createElement("span", {
    className: "lt-badge lt-badge--default",
    style: {
      position: 'absolute',
      top: -12,
      left: '50%',
      transform: 'translateX(-50%)',
      boxShadow: 'var(--shadow-primary-glow)'
    }
  }, "Paling Populer") : null, /*#__PURE__*/React.createElement("h3", {
    style: {
      margin: 0,
      fontSize: 18,
      fontWeight: 600
    }
  }, plan.name), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: '4px 0 0',
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, plan.desc), /*#__PURE__*/React.createElement("p", {
    className: "lt-money",
    style: {
      margin: '16px 0 0',
      fontSize: 30,
      fontWeight: 700
    }
  }, interval_ === 'monthly' ? plan.monthly : plan.annual), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, "/", interval_ === 'monthly' ? 'bulan' : 'tahun'), /*#__PURE__*/React.createElement("ul", {
    style: {
      margin: '20px 0 0',
      padding: 0,
      listStyle: 'none',
      display: 'grid',
      gap: 8,
      fontSize: 14
    }
  }, /*#__PURE__*/React.createElement("li", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 8
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: "Check",
    size: 16,
    style: {
      color: 'var(--success)'
    }
  }), " ", plan.companies, " perusahaan"), /*#__PURE__*/React.createElement("li", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 8
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: "Check",
    size: 16,
    style: {
      color: 'var(--success)'
    }
  }), " ", plan.users, " pengguna"), plan.features.map(f => /*#__PURE__*/React.createElement("li", {
    key: f,
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 8
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: "Check",
    size: 16,
    style: {
      color: 'var(--success)'
    }
  }), " ", f))), /*#__PURE__*/React.createElement("div", {
    style: {
      marginTop: 24
    }
  }, /*#__PURE__*/React.createElement(Button, {
    variant: plan.popular ? 'default' : 'outline',
    style: {
      width: '100%',
      ...(plan.popular ? {
        boxShadow: 'var(--shadow-primary-glow)'
      } : null)
    }
  }, "Mulai Trial Gratis")))))), /*#__PURE__*/React.createElement("section", {
    id: "testimoni",
    style: {
      borderTop: '1px solid var(--border)',
      borderBottom: '1px solid var(--border)',
      background: 'hsl(var(--muted-hsl) / 0.4)'
    },
    "data-screen-label": "Landing \u2014 Testimoni"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 1152,
      margin: '0 auto',
      padding: '80px 24px'
    }
  }, /*#__PURE__*/React.createElement("h2", {
    style: h2Style
  }, "Dipercaya oleh ratusan bisnis Indonesia"), /*#__PURE__*/React.createElement("div", {
    style: {
      marginTop: 48,
      display: 'grid',
      gridTemplateColumns: 'repeat(3, 1fr)',
      gap: 24
    }
  }, testimonials.map(t => /*#__PURE__*/React.createElement("div", {
    key: t.name,
    className: "lt-card",
    style: {
      padding: 24
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      gap: 2,
      color: 'var(--warning)'
    }
  }, [1, 2, 3, 4, 5].map(i => /*#__PURE__*/React.createElement(Icon, {
    key: i,
    name: "Star",
    size: 16,
    style: {
      fill: 'currentColor'
    }
  }))), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: '12px 0 0',
      fontSize: 14,
      color: 'var(--muted-foreground)'
    }
  }, "\u201C", t.text, "\u201D"), /*#__PURE__*/React.createElement("div", {
    style: {
      marginTop: 16,
      display: 'flex',
      alignItems: 'center',
      gap: 12
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      width: 40,
      height: 40,
      alignItems: 'center',
      justifyContent: 'center',
      borderRadius: 999,
      background: 'var(--secondary)',
      fontWeight: 700,
      color: 'var(--primary)'
    }
  }, t.initials), /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontSize: 14,
      fontWeight: 600
    }
  }, t.name), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontSize: 12,
      color: 'var(--muted-foreground)'
    }
  }, t.role)))))))), /*#__PURE__*/React.createElement("section", {
    style: sectionPad,
    "data-screen-label": "Landing \u2014 CTA"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'relative',
      overflow: 'hidden',
      borderRadius: 16,
      background: 'var(--primary)',
      padding: '64px 24px',
      textAlign: 'center',
      color: '#fff',
      boxShadow: '0 24px 60px -20px hsl(var(--primary-hsl) / 0.5)'
    }
  }, /*#__PURE__*/React.createElement("div", {
    className: "floaty",
    style: {
      pointerEvents: 'none',
      position: 'absolute',
      right: -40,
      top: -64,
      width: 256,
      height: 256,
      borderRadius: 999,
      background: 'radial-gradient(circle, rgba(255,255,255,0.16), transparent 70%)'
    }
  }), /*#__PURE__*/React.createElement("div", {
    className: "floaty-slow",
    style: {
      pointerEvents: 'none',
      position: 'absolute',
      bottom: -80,
      left: -32,
      width: 224,
      height: 224,
      borderRadius: 999,
      background: 'radial-gradient(circle, rgba(255,255,255,0.1), transparent 70%)'
    }
  }), /*#__PURE__*/React.createElement("h2", {
    style: {
      ...h2Style,
      position: 'relative',
      color: '#fff'
    }
  }, "Siap mulai perjalanan akuntansi yang lebih mudah?"), /*#__PURE__*/React.createElement("p", {
    style: {
      position: 'relative',
      margin: '12px 0 0',
      color: 'rgba(255,255,255,0.85)'
    }
  }, "Coba gratis selama 14 hari. Tidak perlu kartu kredit."), /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'relative',
      marginTop: 32,
      display: 'flex',
      flexWrap: 'wrap',
      alignItems: 'center',
      justifyContent: 'center',
      gap: 12
    }
  }, /*#__PURE__*/React.createElement(Button, {
    size: "lg",
    style: {
      background: '#fff',
      color: 'var(--primary)'
    }
  }, "Mulai Gratis Sekarang"), /*#__PURE__*/React.createElement(Button, {
    size: "lg",
    variant: "outline",
    style: {
      borderColor: 'rgba(255,255,255,0.3)',
      background: 'transparent',
      color: '#fff',
      boxShadow: 'none'
    }
  }, "Hubungi Sales")))), /*#__PURE__*/React.createElement("footer", {
    style: {
      borderTop: '1px solid var(--border)'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 1152,
      margin: '0 auto',
      display: 'flex',
      flexWrap: 'wrap',
      alignItems: 'center',
      justifyContent: 'space-between',
      gap: 16,
      padding: '32px 24px',
      fontSize: 13,
      color: 'var(--muted-foreground)'
    }
  }, /*#__PURE__*/React.createElement(Wordmark, {
    mark: 22,
    text: 16
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      gap: 20
    }
  }, /*#__PURE__*/React.createElement("a", {
    href: "#",
    style: {
      color: 'inherit'
    }
  }, "Kebijakan Privasi"), /*#__PURE__*/React.createElement("a", {
    href: "#",
    style: {
      color: 'inherit'
    }
  }, "Syarat Layanan")), /*#__PURE__*/React.createElement("span", null, "\xA9 2026 PT Logistax Mitratama Solusi"))));
}
Object.assign(window, {
  LandingScreen
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/landing/LandingScreen.jsx", error: String((e && e.message) || e) }); }

__ds_ns.Alert = __ds_scope.Alert;

__ds_ns.Avatar = __ds_scope.Avatar;

__ds_ns.Badge = __ds_scope.Badge;

__ds_ns.Button = __ds_scope.Button;

__ds_ns.Card = __ds_scope.Card;

__ds_ns.CardHeader = __ds_scope.CardHeader;

__ds_ns.CardTitle = __ds_scope.CardTitle;

__ds_ns.CardDescription = __ds_scope.CardDescription;

__ds_ns.CardContent = __ds_scope.CardContent;

__ds_ns.CardFooter = __ds_scope.CardFooter;

__ds_ns.Icon = __ds_scope.Icon;

__ds_ns.Separator = __ds_scope.Separator;

__ds_ns.Skeleton = __ds_scope.Skeleton;

__ds_ns.Dialog = __ds_scope.Dialog;

__ds_ns.EmptyState = __ds_scope.EmptyState;

__ds_ns.Toast = __ds_scope.Toast;

__ds_ns.Checkbox = __ds_scope.Checkbox;

__ds_ns.Input = __ds_scope.Input;

__ds_ns.Label = __ds_scope.Label;

__ds_ns.MoneyInput = __ds_scope.MoneyInput;

__ds_ns.Select = __ds_scope.Select;

__ds_ns.Breadcrumbs = __ds_scope.Breadcrumbs;

__ds_ns.Pagination = __ds_scope.Pagination;

__ds_ns.Sidebar = __ds_scope.Sidebar;

})();
