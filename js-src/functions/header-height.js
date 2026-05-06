import vars from '../_vars';

export const getHeaderHeight = () => {
  const headerHeight = vars.header?.offsetHeight;
  document.querySelector(':root').style.setProperty('--header-height', `${headerHeight}px`);
}
