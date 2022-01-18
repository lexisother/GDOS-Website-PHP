#!/usr/bin/zsh

bin="/home/$USER/.dotfiles/scripts/markdown2htmldoc"

pprint() {
  if [[ $indent -lt 1 ]]; then
    indent=0
  else
    indent=$2
  fi;

  for i in $(seq 1 $indent); do
    echo -n "‎"
  done;

  echo -e "$(print -P '%F{8}==>%f') $1"
}

function indent () {
    local string="$1"
    local num_spaces="$2"
    local arrow="$3"

    if [ "$arrow" = true ]; then
      printf "$(tput setaf 8)%${num_spaces}s$(tput sgr0)%s\n" "==> " "$string"
    else
      printf "%${num_spaces}s%s\n" "" "$string"
    fi
}

for file in $(find . -type f -name "*.md"); do
  pprint "Building $file..."
  $bin $file $file.html
  indent "Built $file to $file.html." 4 false
done
