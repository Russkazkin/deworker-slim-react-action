import { setWorldConstructor } from '@cucumber/cucumber';

function CustomWorld()
{
  this.browser = null;
  this.page = null;
}

setWorldConstructor(CustomWorld);
