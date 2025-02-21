# Localization

Text is translated using [GlotPress](https://translate.wordpress.com) but the
process of getting original strings into GlotPress and the translations back
into the app is somewhat manual at the moment.

## Supported Languages

We currently support the magnificent 16 languages defined in `src/lib/locale.ts`,
as well as Polish, Vietnamese and Ukrainian.

## Translation Process

### Extract and Import

#### Step 1: Extract Strings:

   1. Run `wp i18n make-pot . --domain=studio-companion-plugin languages/studio-companion-plugin.pot` to get the text out of the source
   files.

   This will create a `*.pot` file bundle of all translatable strings in `studio-companion-plugin.pot`.

#### Step 2: Import to GlotPress:

   1. Open [our project in GlotPress](https://translate.wordpress.com/projects/studio/studio-companion-plugin/).
   2. Click the **Project actions** menu. You must be a proxied Automattician to view the menu.
   3. Click **Import Originals**.
   4. Import `studio-companion-plugin.pot` (auto-detecting the file format is fine).

### Export and Add

#### Step 1: Export from GlotPress:

We will export the translations as Language Pack (.zip), which is a format
WordPress can understand. It's ok if some translations are missing,
they will be left as English in the app.

   1. Open [our project in GlotPress](https://translate.wordpress.com/projects/studio/studio-companion-plugin/).
   2. Click the **Project actions** menu.
   3. Click **Bulk Export**.
   4. Click **Select WP.Com Priority Languages** to only the magnificent 16 languages.
   5. Select **Polish**, **Vietnamese** and **Ukrainian** too.
   6. Change the format to `Language Pack (.zip)`.
   7. Leave the other fields as default and click **Export**.

#### Step 2: Add Translations to Project:
   1. Unzip the exported strings:
```
unzip FILE.zip -d tmp
find tmp -name "*.zip" -exec unzip -o {} -d tmp/ \;
find tmp -type f ! -name "*.mo" -delete
```
   2. Add them to the `langauges` and overwrite the files in there with your new files.
