#!/bin/bash

cd /var/lib/docker/volumes/bia_wordpress_data/_data

git pull origin main

# Adiciona arquivos novos e modificados
git add .

# Só faz commit se houver mudanças
if ! git diff --cached --quiet; then
  git commit -m "Auto commit: atualização no WordPress em $(date '+%d/%m/%Y %H:%M')"
  git push origin main
else
  echo "Nenhuma alteração detectada. Nada para subir."
fi
