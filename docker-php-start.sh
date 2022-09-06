#!/bin/bash

set -e

a2enmod rewrite
apache2-foreground
