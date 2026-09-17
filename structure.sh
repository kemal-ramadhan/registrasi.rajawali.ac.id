#!/bin/bash

PROJECT="$(pwd)"
OUTPUT="$PROJECT/dump"

mkdir -p "$OUTPUT"

OUTFILE="$OUTPUT/structure.txt"

echo "Generating structure..."

find "$PROJECT" \
    -type d \( \
        -name vendor -o \
        -name node_modules -o \
        -name storage -o \
        -name bootstrap/cache -o \
        -name .git \
    \) -prune \
    -o -type f \
    | sed "s|$PROJECT/||" \
    | sort > "$OUTFILE"

echo "Generated: $OUTFILE"
