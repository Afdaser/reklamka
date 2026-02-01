/* global articleViewTracker */
// Відправляємо перегляд через AJAX, щоб обхід кешу давав точні цифри.
document.addEventListener('DOMContentLoaded', () => {
    if (!articleViewTracker || !articleViewTracker.ajaxUrl || !articleViewTracker.postId) {
        return;
    }

    // Використовуємо fetch для простого та надійного інкременту.
    const payload = new URLSearchParams({
        action: 'track_article_view',
        post_id: articleViewTracker.postId,
        nonce: articleViewTracker.nonce,
    });

    fetch(articleViewTracker.ajaxUrl, {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        },
        body: payload.toString(),
    }).catch(() => {
        // Безпечна тиша: не ламаємо сторінку, якщо запит не вдався.
    });
});
