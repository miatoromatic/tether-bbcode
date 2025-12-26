# Template Modifications Guide

This guide explains how to manually add template modifications to include the JavaScript and CSS for the Tether BBCode System.

## Why Template Modifications?

XenForo 2.x requires custom JavaScript and CSS to be included in templates. While some addons can do this automatically, due to XenForo's behavior with templates, you may need to add these manually to ensure everything works correctly.

## Required Template Modifications

### 1. Include JavaScript (Required)

This modification ensures the tether popup JavaScript is loaded on all pages.

**Create Template Modification:**
- **Name**: `Miatoro Tether - Include JavaScript`
- **Description**: Includes the Tether BBCode JavaScript handler
- **Template**: `PAGE_CONTAINER`
- **Modification Key**: `miatoro_tether_js_include`
- **Execution Order**: `10`
- **Action**: Find and replace

**Find:**
```html
{xf:if $pageParams.includeFooterJs}
	<xf:js />
</xf:if>
```

**Replace:**
```html
{xf:if $pageParams.includeFooterJs}
	<xf:js />
</xf:if>
<xf:include template="miatoro_tether_js" />
```

**Alternative Location (if above doesn't work):**

**Find:**
```html
</body>
```

**Replace:**
```html
<xf:include template="miatoro_tether_js" />
</body>
```

---

### 2. Include CSS (Required)

This modification ensures the tether styling is applied to all pages.

**Create Template Modification:**
- **Name**: `Miatoro Tether - Include CSS`
- **Description**: Includes the Tether BBCode styles
- **Template**: `PAGE_CONTAINER`
- **Modification Key**: `miatoro_tether_css_include`
- **Execution Order**: `10`
- **Action**: Find and replace

**Find:**
```html
<xf:css src="public:core.less" />
```

**Replace:**
```html
<xf:css src="public:core.less" />
<xf:css src="miatoro_tether.less" />
```

**Alternative Method:**

You can also add it in the extra.less template:

**Template**: `extra.less`

**Add at the bottom:**
```less
@import "miatoro_tether.less";
```

---

## Manual Template Creation

If the templates are not automatically imported during installation, you'll need to manually create them in the Admin CP.

### How to Create Templates Manually

1. **Navigate to**: Admin CP → Appearance → Templates
2. **Click**: "Add template"
3. **Select Type**: `Public` or `Admin` (depending on template)
4. **Enter Template Name**: (see below for names)
5. **Paste Template Code**: Copy from the `_output/templates/` directory
6. **Save**

### Admin Templates to Create

Navigate to: **Admin CP → Appearance → Templates → Admin**

#### Template: `miatoro_tether_list`
Location: `src/addons/Miatoro/Tether/_output/templates/admin/miatoro_tether_list.html`

#### Template: `miatoro_tether_edit`
Location: `src/addons/Miatoro/Tether/_output/templates/admin/miatoro_tether_edit.html`

#### Template: `miatoro_tether_delete`
Location: `src/addons/Miatoro/Tether/_output/templates/admin/miatoro_tether_delete.html`

---

### Public Templates to Create

Navigate to: **Admin CP → Appearance → Templates → Public**

#### Template: `miatoro_tether_bbcode`
Location: `src/addons/Miatoro/Tether/_output/templates/public/miatoro_tether_bbcode.html`

#### Template: `miatoro_tether_popup`
Location: `src/addons/Miatoro/Tether/_output/templates/public/miatoro_tether_popup.html`

#### Template: `miatoro_tether_js`
Location: `src/addons/Miatoro/Tether/_output/templates/public/miatoro_tether_js.html`

#### Template: `miatoro_tether.less`
**Type**: `public:` (CSS/LESS)
Location: `src/addons/Miatoro/Tether/_output/templates/public/miatoro_tether.less`

---

## Verification

### Check JavaScript is Loaded

1. Open any forum page
2. Open browser developer tools (F12)
3. Go to Console tab
4. Type: `XF.MiatoroTetherTrigger`
5. If it returns a function/object, JavaScript is loaded correctly

### Check CSS is Loaded

1. Open any forum page
2. Open browser developer tools (F12)
3. Go to Elements/Inspector tab
4. Look for `<link>` or `<style>` tag containing `miatoro_tether`
5. Or check Computed styles on any element for `.miatoro-tether` classes

### Test BBCode

1. Create a test post with:
   ```
   [tether=test-tether]positive1,negative1[/tether]
   ```
2. Check if an image appears (or placeholder)
3. Click the image - a popup should appear

---

## Troubleshooting Template Modifications

### JavaScript Not Working

**Problem**: Clicking tether images does nothing

**Solutions**:
1. Verify JavaScript template is included
2. Check browser console for errors
3. Clear XenForo template cache: Admin CP → Tools → Rebuild caches
4. Try adding the JavaScript include right before `</body>` tag

### CSS Not Applied

**Problem**: Tethers appear unstyled

**Solutions**:
1. Verify CSS template is created and included
2. Clear browser cache
3. Clear XenForo template cache
4. Check if LESS compilation is enabled: Admin CP → Setup → Options → Styles and templates

### Templates Not Appearing

**Problem**: Templates don't show up after creating them

**Solutions**:
1. Make sure you selected the correct type (Public vs Admin)
2. Rebuild master data: Admin CP → Tools → Rebuild caches
3. Check that the addon is enabled
4. Verify file permissions if using file-based templates

### Popup Overlay Not Working

**Problem**: Popup opens but looks broken

**Solutions**:
1. Check XenForo's core overlay system is working on other overlays
2. Verify JavaScript is loaded (see Verification section above)
3. Check for JavaScript errors in console
4. Ensure jQuery is loaded on the page

---

## Advanced: Adding to Specific Pages Only

If you want to load the JavaScript/CSS only on pages that need it:

### Conditional JavaScript Loading

**In template**: `miatoro_tether_bbcode.html`

Add at the top:
```html
<xf:require css="miatoro_tether.less" />
<xf:require js="miatoro_tether_js" />
```

Then you don't need the PAGE_CONTAINER modifications.

### Conditional CSS Loading

Use XenForo's `<xf:css>` tag with conditions:

```html
<xf:if is="$xf.page.pageType == 'thread_view' OR $xf.page.pageType == 'post'">
    <xf:css src="miatoro_tether.less" />
</xf:if>
```

---

## Style Properties (Optional)

You can create style properties to make the addon more customizable:

**Navigate to**: Admin CP → Appearance → Style properties

**Create property group**: `Miatoro Tether`

**Example properties to add**:
- `miatoro_tether_image_size`: Image size (default: 100px)
- `miatoro_tether_hover_opacity`: Hover opacity (default: 0.8)
- `miatoro_tether_active_color`: Active effect highlight color

Then use these in the LESS template:
```less
.miatoro-tether-image {
    max-width: @miatoro_tether_image_size;
    max-height: @miatoro_tether_image_size;
}
```

---

## Need Help?

If you're having trouble with template modifications:

1. Check XenForo documentation on template modifications
2. Review the Server error log: Admin CP → Tools → Server error log
3. Enable debug mode in `config.php`: `$config['debug'] = true;`
4. Check browser console for JavaScript errors
5. Verify all templates are in the correct location

---

## Summary Checklist

- [ ] JavaScript template created: `miatoro_tether_js`
- [ ] CSS template created: `miatoro_tether.less`
- [ ] BBCode template created: `miatoro_tether_bbcode`
- [ ] Popup template created: `miatoro_tether_popup`
- [ ] Admin templates created (list, edit, delete)
- [ ] JavaScript included in PAGE_CONTAINER
- [ ] CSS included in PAGE_CONTAINER or extra.less
- [ ] Template cache rebuilt
- [ ] Browser cache cleared
- [ ] Tested with sample BBCode
- [ ] Verified popup functionality

Once all items are checked, your Tether BBCode System should be fully functional!
