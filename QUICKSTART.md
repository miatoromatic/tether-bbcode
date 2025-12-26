# Quick Start Guide - Tether BBCode System

Get up and running with the Tether BBCode System in 5 minutes!

## Step 1: Install the Addon (2 minutes)

### Method A: Via Admin CP (Recommended)

1. **Upload** the `src/addons/Miatoro/Tether` folder to your XenForo installation:
   ```
   /path/to/xenforo/src/addons/Miatoro/Tether
   ```

2. **Install**:
   - Go to Admin CP → Add-ons
   - Click "Install add-on"
   - Choose "Install from directory"
   - Enter: `Miatoro/Tether`
   - Click "Install add-on"

### Method B: Via Command Line

```bash
cd /path/to/xenforo
php cmd.php xf-addon:install Miatoro/Tether
```

## Step 2: Import Sample Data (1 minute)

**Optional but recommended for testing**

Import the example tether data:

```bash
mysql -u your_user -p your_database < example_tether_data.sql
```

Or via phpMyAdmin:
1. Select your XenForo database
2. Click "Import"
3. Choose `example_tether_data.sql`
4. Click "Go"

This will create 5 sample tethers you can use for testing.

## Step 3: Add Template Modifications (1 minute)

### Auto-include JavaScript and CSS

**Option A: Quick Template Edit**

1. Go to Admin CP → Appearance → Templates
2. Search for: `PAGE_CONTAINER`
3. Click to edit
4. Find: `</body>`
5. Add BEFORE it:
   ```html
   <xf:include template="miatoro_tether_js" />
   ```

6. Find: `<xf:css src="public:core.less" />`
7. Add AFTER it:
   ```html
   <xf:css src="miatoro_tether.less" />
   ```

8. Save

**Option B: Via extra.less**

1. Go to Admin CP → Appearance → Templates
2. Search for: `extra.less`
3. Add at the bottom:
   ```less
   @import "miatoro_tether.less";
   ```
4. Save

For JavaScript, follow Option A above.

## Step 4: Rebuild Caches (30 seconds)

1. Go to Admin CP → Tools → Rebuild caches
2. Check all boxes
3. Click "Rebuild"

## Step 5: Test It! (30 seconds)

### Create a Test Post

1. Create a new post or reply
2. Use this BBCode:
   ```
   [tether=arachnas-swansong]positive1,negative4[/tether]
   ```

3. Submit the post
4. You should see a tether image
5. Click it - a popup should appear with details

### If Sample Data Was Imported

Try all 5 sample tethers:

```
[tether=arachnas-swansong]positive1,negative4[/tether]
[tether=shadow-binding]positive2,negative1[/tether]
[tether=void-whisper]positive3,negative3[/tether]
[tether=feast-eternal]positive1,negative2[/tether]
[tether=blood-oath]positive2,negative2[/tether]
```

## Step 6: Add Your First Custom Tether

1. Go to Admin CP → Content → Manage Tethers
2. Click "Add Tether"
3. Fill in the form:
   - **Identifier**: `my-first-tether` (no spaces, lowercase)
   - **Title**: `My First Tether`
   - **Category**: Choose one (e.g., "Death")
   - **Description**: Describe your tether
   - **Negative 1**: `Deepen I: Your first negative effect`
   - **Positive 1**: `Mend I: Your first positive effect`
4. Save

5. Test it in a post:
   ```
   [tether=my-first-tether]positive1,negative1[/tether]
   ```

## Troubleshooting

### BBCode Not Working
- Check: Admin CP → Content → BB codes → verify "tether" exists
- Solution: Rebuild caches

### Images Not Showing
- Default path: `/public_html/db/{identifier}.webp`
- Check: File permissions on `/db/` folder
- Solution: Add image or specify custom path in tether settings

### Popup Not Opening
- Check: Browser console for errors (F12)
- Solution: Verify JavaScript template is included
- Solution: Clear browser cache

### Admin Panel Missing
- Check: Admin CP → Add-ons → verify addon is enabled
- Solution: Rebuild admin navigation cache

## Next Steps

### Add Images

1. Create/upload tether images to:
   ```
   /public_html/db/tethers/your-tether-name.webp
   ```

2. Recommended size: 100x100px or 500x500px
3. Format: WebP (or PNG/JPG)

### Customize Styling

Edit the LESS template:
- Admin CP → Appearance → Templates
- Search: `miatoro_tether.less`
- Modify colors, sizes, effects

### Add More Categories

Edit files:
- `src/addons/Miatoro/Tether/Entity/Tether.php`
- `src/addons/Miatoro/Tether/Repository/Tether.php`

### Create More Tethers

Use the admin panel:
- Admin CP → Content → Manage Tethers → Add Tether

Or programmatically via PHP:
```php
$tether = \XF::em()->create('Miatoro\Tether:Tether');
$tether->identifier = 'new-tether';
$tether->title = 'New Tether';
// ... set other fields
$tether->save();
```

## Need More Help?

- **Full Installation Guide**: See [INSTALLATION.md](INSTALLATION.md)
- **Template Details**: See [TEMPLATE_MODIFICATIONS.md](TEMPLATE_MODIFICATIONS.md)
- **Feature Overview**: See [README.md](README.md)

## BBCode Format Reference

### Basic Usage
```
[tether=identifier]positive1,negative5[/tether]
```

### Parameters
- `identifier`: The unique tether ID (e.g., "arachnas-swansong")
- `positive1`: Unlocked positive level (1-7)
- `negative5`: Unlocked negative level (1-7)

### Multiple Tethers
```
[tether=tether1]positive1,negative1[/tether]
[tether=tether2]positive2,negative3[/tether]
[tether=tether3]positive1,negative7[/tether]
```

### No Effects Unlocked
```
[tether=identifier]positive0,negative0[/tether]
```

## That's It!

You now have a fully functional Tether BBCode System! 🎉

Users can now add tethers to their posts, and you can manage them via the admin panel.

---

**Questions?** Check the full documentation in the other MD files!
