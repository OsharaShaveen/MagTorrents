# MagTorrents

MagTorrents is a torrent site for downloading films.

### How to install?

1. In the file `src/Config.php` edit the constant `BASE_URL` to the current site URL.
2. In `src/Config.php` set the database constants `DB_HOST`, `DB_USER`, `DB_PASS` and `DB_NAME`.
3. Set the web server to point to `public/` as the directory root.

Then just browse to your local URL. (e.g. `http://localhost/magtorrents/`)