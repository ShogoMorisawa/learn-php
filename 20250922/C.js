function main(input) {
  const arr = input.split('').map(Number);
  let count = 0;
  for (const a of arr) {
    if (a === 1) count++;
  }
  console.log(count);
}

main(require('fs').readFileSync('/dev/stdin', 'utf8'));
