# ArchXChange.com - Architecture Portfolio Platform
# Migrated from Dathorn cPanel to aaPanel (2026-07-20)

## Structure
- `public_html/` - Web root (deploy to /www/wwwroot/archxchange.com/)
- `secure/` - Sensitive config files (deploy to /www/wwwroot/secure/archxchange/)
- `sql/` - Database dump

## Deployment
1. Create database `sql_archxchange_com` with user `archx_access`
2. Import `sql/archx_01.sql` 
3. Deploy `public_html/` → `/www/wwwroot/archxchange.com/`
4. Deploy `secure/` → `/www/wwwroot/secure/archxchange/`
5. PHP 7.4+ required (mysqli extension)

## Security Notes
- Deprecated `mysql_*` functions upgraded to `mysqli_*`
- SQL injection: `db_escape()` wrapper added (wraps mysqli_real_escape_string)
- File upload: Added MIME type, extension, and image validation
- `escapeshellarg()` added to ImageMagick exec calls
- `eregi()` replaced with `preg_match()` throughout
