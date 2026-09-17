#!/bin/bash

# Konfigurasi Direktori dan Waktu
DATE=$(date +%Y-%m-%d_%H%M)
BACKUP_DIR="/var/www/html/pendaftaran.universitas-bth.ac.id"
GDRIVE_DEST="gdrive:Backup_Staging_PMB_UBTH"
LOG_FILE="$BACKUP_DIR/backup.log"

echo "=== Backup started: $(date) ===" > "$LOG_FILE"

# 1. Kompresi Kodingan (Kecualikan file backup agar tidak terjadi looping/bengkak)
echo "Sedang mengompresi file code..." >> "$LOG_FILE"
tar -czf "$BACKUP_DIR/bth-code-$DATE.tar.gz" --exclude='*.tar.gz' --exclude='*.sql.gz' --exclude='backup.log' "$BACKUP_DIR"

# 2. Upload Kodingan ke GDrive (Dengan flag anti Rate-Limit)
echo "Mengupload file code ke Google Drive..." >> "$LOG_FILE"
rclone copy "$BACKUP_DIR/bth-code-$DATE.tar.gz" "$GDRIVE_DEST/code/" \
  --tpslimit 3 \
  --transfers 2 \
  --checkers 2 \
  --drive-chunk-size 128M \
  --drive-pacer-min-sleep 10ms \
  -v >> "$LOG_FILE" 2>&1

# 3. Upload Database ke GDrive (Dengan flag anti Rate-Limit)
echo "Mengupload file database ke Google Drive..." >> "$LOG_FILE"
rclone copy "$BACKUP_DIR/bth-db-2026-06-15_1437.sql.gz" "$GDRIVE_DEST/db/" \
  --tpslimit 3 \
  --transfers 2 \
  --checkers 2 \
  --drive-chunk-size 128M \
  --drive-pacer-min-sleep 10ms \
  -v >> "$LOG_FILE" 2>&1

echo "=== Backup finished: $(date) ===" >> "$LOG_FILE"
