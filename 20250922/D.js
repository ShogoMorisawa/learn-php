function main(input) {
  const str = input.trim();
  const map = new Map();

  // aからzまでの文字をキーとして、値は0でMapを作成
  for (let i = 0; i < 26; i++) {
    const char = String.fromCharCode(97 + i); // 97は'a'のASCIIコード
    map.set(char, 0);
  }

  for (const s of str) {
    map.set(s, map.get(s) + 1);
  }

  for (const [key, value] of map) {
    if (value === 0) {
      console.log(key);
      return;
    }
  }
}

main(require('fs').readFileSync('/dev/stdin', 'utf8'));
