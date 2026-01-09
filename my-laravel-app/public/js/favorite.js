document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('favorite-btn');
  const heart = document.getElementById('favorite-heart');
  if (!btn || !heart) return;

  const tokenMeta = document.querySelector('meta[name="csrf-token"]');
  if (!tokenMeta) {
    console.error('CSRF token meta not found');
    return;
  }
  const token = tokenMeta.getAttribute('content');

  btn.addEventListener('click', async () => {
    try {
      const productId = btn.dataset.productId;
      const isFavorited = btn.dataset.favorited === '1';

      const url = `/ec/products/${productId}/favorite`;
      const method = isFavorited ? 'DELETE' : 'POST';

      const response = await fetch(url, {
        method,
        credentials: 'same-origin',
        headers: {
          'X-CSRF-TOKEN': token,
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        },
      });

      // まず text で受けてログ（JSONでも文字列として来る）
      const text = await response.text();
      console.log('status:', response.status);
      console.log('response:', text);

      if (!response.ok) {
        // ここでユーザー向け表示したいならalertでもOK
        alert('お気に入りの更新ができません（' + response.status + '）');
        return;
      }

      // OKなら JSON に変換
      const data = JSON.parse(text);

      btn.dataset.favorited = data.favorited ? '1' : '0';
      heart.style.color = data.favorited ? 'red' : '#999';
    } catch (e) {
      console.error(e);
      alert('お気に入りの更新ができません');
    }
  });
});
