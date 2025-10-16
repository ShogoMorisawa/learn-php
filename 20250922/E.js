function main(input) {
  const lines = input.split('\n');
  const N = +lines[0];
  const S = lines.slice(1, N + 1).map((line) => line.split(''));
  const T = lines.slice(N + 1).map((line) => line.split(''));

  const rotate = (grid) => {
    const res = Array.from({ length: N }, () => Array(N).fill('.'));
    for (let i = 0; i < N; i++) {
      for (let j = 0; j < N; j++) {
        res[j][N - 1 - i] = grid[i][j];
      }
    }
    return res;
  };

  const diffCount = (grid1, grid2) => {
    let count = 0;
    for (let i = 0; i < N; i++) {
      for (let j = 0; j < N; j++) {
        if (grid1[i][j] !== grid2[i][j]) {
          count++;
        }
      }
    }
    return count;
  };

  let ans = Infinity;
  let cur = S;

  for (let i = 0; i < 4; i++) {
    ans = Math.min(ans, diffCount(cur, T) + i);
    cur = rotate(cur);
  }

  console.log(ans);
}
main(require('fs').readFileSync('/dev/stdin', 'utf8'));
