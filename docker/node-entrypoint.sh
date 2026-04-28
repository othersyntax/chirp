#!/bin/sh
set -e

echo "Installing Node dependencies..."
npm install

echo "Starting Vite dev server..."
exec npm run dev -- --host --port 3001

