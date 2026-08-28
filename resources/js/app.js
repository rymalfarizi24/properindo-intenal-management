import './bootstrap';
import Trix from "trix"
import Picker from 'vanilla-picker';

window.Picker = Picker;

document.addEventListener("trix-before-initialize", () => {
  // Change Trix.config if you need
})
