const anchors = document.querySelectorAll('#aside a');

for (let i = 0; i < anchors.length; i++) {
  if (anchors[i].getAttribute('href')) {
    if (document.baseURI.includes(anchors[i].getAttribute('href'))) {
      anchors[i].classList.toggle('current');
    }
    // console.log(anchors[i].getAttribute('href'));
    // console.log('yes');
  }
}
