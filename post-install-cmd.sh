#!/bin/sh
if [ -n "$DYNO" ]
then
    php init --env=dev --overwrite=All
fi
