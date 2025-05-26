/**
 * Minified by jsDelivr using Terser v5.37.0.
 * Original file: /npm/lazy-youtube-player@0.3.0/yt-player.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
export class LazyYouTubePlayer {
  constructor(e, t) {
    this.element = e, this.options = {thumbnailQuality: "hqdefault", ...t}, this.init()
  }

  init() {
    this.element.classList.add("NexYt-player"), this.loadThumbnail(), this.addPlayButton(), this.element.addEventListener("click", (() => this.loadIframe()))
  }

  loadThumbnail() {
    const e = `https://img.youtube.com/vi/${this.options.videoId}/${this.options.thumbnailQuality}.jpg`,
        t = new Image;
    t.src = e, t.alt = "YouTube video thumbnail", t.classList.add("NexYt-thumbnail"), t.onload = () => {
      this.element.appendChild(t)
    }, t.onerror = () => {
      console.error("Failed to load thumbnail image.")
    }
  }

  addPlayButton() {
    const e = document.createElement("div");
    e.classList.add("NexYt-play-btn"), e.setAttribute("role", "button"), e.setAttribute("aria-label", "Play video"), e.innerHTML = this.options.playButtonSvg || "\n      <svg viewBox='0 0 213.7 213.7'>\n        <polygon class='t' points='73.5,62.5 148.5,105.8 73.5,149.1'></polygon>\n        <circle class='c' cx='106.8' cy='106.8' r='103.3'></circle>\n      </svg>\n    ", this.element.appendChild(e)
  }

  loadIframe() {
    const e = document.createElement("div");
    e.classList.add("NexYt-spinner"), this.element.innerHTML = "", this.element.appendChild(e);
    const t = document.createElement("iframe");
    t.src = `https://www.youtube-nocookie.com/embed/${this.options.videoId}?rel=0&showinfo=0&autoplay=1`, 
        t.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture", 
        t.referrerpolicy = "strict-origin-when-cross-origin",
        t.allowFullscreen = !0, 
        t.classList.add("NexYt-iframe"), this.element.appendChild(t)
  }
}

export function initLazyYoutubePlayers() {
  document.querySelectorAll(".NexosYt").forEach((e => {
    const t = e, i = t.dataset.embed;
    i && new LazyYouTubePlayer(t, {videoId: i})
  }))
}

initLazyYoutubePlayers();
//# sourceMappingURL=/sm/7bbb5596d11928adb0fbcf0aa65352ce6f32695b7be07a00b1c4ce6146b4a9b6.map