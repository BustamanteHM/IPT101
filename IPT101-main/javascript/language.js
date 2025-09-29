document.addEventListener('DOMContentLoaded', function () {
  const languageSelector = document.getElementById('languageSelector');
  const translations = {
    en: {
      greetingText: "Hello, I'm Harold Mark",
      heroDescription: "I'm a passionate web developer creating impactful digital solutions.",
      skillsTitle: "Skills",
      educationTitle: "Educational Background",
      projectsTitle: "Recent Projects",
      posTitle: "Simple POS System",
      posDescription: "A VB.NET POS with inventory management and receipt printing.",
      portfolioTitle: "Portfolio Website",
      portfolioDescription: "This personal portfolio using HTML and CSS.",
      contactTitle: "Contact Me",
      namePlaceholder: "Your Name",
      emailPlaceholder: "Your Email",
      messagePlaceholder: "Your Message",
      submitButton: "Send Message"
    },
    fil: {
      greetingText: "Kamusta, Ako si Harold Mark",
      heroDescription: "Ako ay isang masigasig na web developer na lumilikha ng makabuluhang digital na solusyon.",
      skillsTitle: "Kasanayan",
      educationTitle: "Edukasyonal na Background",
      projectsTitle: "Mga Proyekto",
      posTitle: "Simpleng POS System",
      posDescription: "Isang VB.NET POS na may pamamahala ng imbentaryo at pag-print ng resibo.",
      portfolioTitle: "Website ng Portfolio",
      portfolioDescription: "Ang personal na portfolio na ito gamit ang HTML at CSS.",
      contactTitle: "Makipag-ugnayan sa Akin",
      namePlaceholder: "Iyong Pangalan",
      emailPlaceholder: "Iyong Email",
      messagePlaceholder: "Iyong Mensahe",
      submitButton: "Ipadala ang Mensahe"
    }
  };

  function setLanguage(lang) {
    const t = translations[lang];
    document.getElementById('greetingText').textContent = t.greetingText;
    document.getElementById('heroDescription').textContent = t.heroDescription;
    document.getElementById('skillsTitle').textContent = t.skillsTitle;
    document.getElementById('educationTitle').textContent = t.educationTitle;
    document.getElementById('projectsTitle').textContent = t.projectsTitle;
    document.getElementById('posTitle').textContent = t.posTitle;
    document.getElementById('posDescription').textContent = t.posDescription;
    document.getElementById('portfolioTitle').textContent = t.portfolioTitle;
    document.getElementById('portfolioDescription').textContent = t.portfolioDescription;
    document.getElementById('contactTitle').textContent = t.contactTitle;
    document.getElementById('name').placeholder = t.namePlaceholder;
    document.getElementById('email').placeholder = t.emailPlaceholder;
    document.getElementById('message').placeholder = t.messagePlaceholder;
    document.getElementById('submitButton').textContent = t.submitButton;
  }

  languageSelector.addEventListener('change', function () {
    setLanguage(this.value);
  });

  // Set default language
  setLanguage(languageSelector.value);
});