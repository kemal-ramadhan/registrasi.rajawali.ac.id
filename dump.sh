#!/bin/bash

PROJECT="$(pwd)"
OUTPUT="$PROJECT/dump"

mkdir -p "$OUTPUT"
mkdir -p "$OUTPUT/app"

dump_folder() {
    NAME="$1"
    FOLDER="$2"

    if [ ! -d "$FOLDER" ]; then
        echo "Skip: $FOLDER tidak ditemukan"
        return
    fi

    OUTFILE="$NAME"

    echo "Generating $OUTFILE ..."

    > "$OUTFILE"

    find "$FOLDER" -type f \
    \( \
        -name "*.php" -o \
        -name "*.blade.php" -o \
        -name "*.js" -o \
        -name "*.ts" \
    \) | sort | while read -r FILE
    do
        {
            echo
            echo "=================================================="
            echo "FILE: $FILE"
            echo "=================================================="
            cat "$FILE"
            echo
        } >> "$OUTFILE"
    done

    echo "Generated: $OUTFILE"
}

# APP
dump_folder "$OUTPUT/app/Exports.txt" "$PROJECT/app/Exports"
dump_folder "$OUTPUT/app/Http.txt" "$PROJECT/app/Http"
dump_folder "$OUTPUT/app/Imports.txt" "$PROJECT/app/Imports"
dump_folder "$OUTPUT/app/Jobs.txt" "$PROJECT/app/Jobs"
dump_folder "$OUTPUT/app/Livewire.txt" "$PROJECT/app/Livewire"
dump_folder "$OUTPUT/app/Mail.txt" "$PROJECT/app/Mail"
dump_folder "$OUTPUT/app/Models.txt" "$PROJECT/app/Models"
dump_folder "$OUTPUT/app/Providers.txt" "$PROJECT/app/Providers"
dump_folder "$OUTPUT/app/Repositories.txt" "$PROJECT/app/Repositories"
dump_folder "$OUTPUT/app/Services.txt" "$PROJECT/app/Services"
dump_folder "$OUTPUT/app/View.txt" "$PROJECT/app/View"

# FOLDER LAIN
dump_folder "$OUTPUT/config.txt" "$PROJECT/config"
dump_folder "$OUTPUT/database.txt" "$PROJECT/database"
dump_folder "$OUTPUT/resources.txt" "$PROJECT/resources"
dump_folder "$OUTPUT/routes.txt" "$PROJECT/routes"
dump_folder "$OUTPUT/tests.txt" "$PROJECT/tests"

echo
echo "===================================="
echo "DONE!"
echo "Output Folder: $OUTPUT"
echo "===================================="
