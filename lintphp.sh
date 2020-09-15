#!/bin/bash

## Based on https://gist.github.com/mathiasverraes/3096500

error=false
while test $# -gt 0; do
    current=$1
    shift

    if [ ! -d $current ] && [ ! -f $current ] ; then
        echo "Invalid directory or file: $current"
        error=true

        continue
    fi
    for i in `find $current -type f -name "*.php"` ;
    do 
    echo $i;
    RESULT=`php -l $i` 
   if [ "$RESULT" != "No syntax errors detected in $i" ] ; then
            echo $RESULT
            error=true
        fi
done
done


if [ "$error" = true ] ; then
    echo "Issues detected, signaling pipeline to shut down. "
    exit 1
else
    echo "No issues detected."
    exit 0
fi