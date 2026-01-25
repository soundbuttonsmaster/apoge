


const player = document.body.querySelector("amp-story-player");

player.addEventListener("ready", () => {
  initializeClickListeners();
});

if (player.isReady) {
  initializeClickListeners();
}

function initializeClickListeners() {
  const entryPoint = document.querySelector('.entry-points');
  const stories = player.getStories();
  
  entryPoint.addEventListener('click', (event) => {
    let card = event.target.closest('.entry-point-card-container');
    
    if (!card) return;
    
    let idx = 0;
    while((card = card.previousElementSibling) != null) {
      idx++;
    }
    
    player.show(stories[idx].href);
  });
}


