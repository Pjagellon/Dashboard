const tabs = document.querySelectorAll('.tab-btn');
const contents = document.querySelectorAll('.tab-content');
const links = document.querySelectorAll('.sidebar a');

// Switch tabs
tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    tabs.forEach(t => t.classList.remove('active'));
    contents.forEach(c => c.classList.remove('active'));

    tab.classList.add('active');
    document.getElementById(tab.dataset.tab).classList.add('active');
  });
});

// Toggle submenus
document.querySelectorAll('.has-sub').forEach(item => {
  item.addEventListener('click', e => {
    if (e.target.tagName !== 'A') {
      e.stopPropagation();
      item.classList.toggle('open');
    }
  });
});

// Load link into iframe
links.forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    const targetSection = document.getElementById(link.dataset.target);
    const iframe = targetSection.querySelector('iframe');

    iframe.src = link.getAttribute('href');

    // Switch to correct tab
    tabs.forEach(t => t.classList.remove('active'));
    contents.forEach(c => c.classList.remove('active'));

    document.querySelector(`.tab-btn[data-tab="${link.dataset.target}"]`)?.classList.add('active');
    targetSection.classList.add('active');
  });
});
