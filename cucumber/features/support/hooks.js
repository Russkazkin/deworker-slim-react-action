import puppeteer from 'puppeteer';
import { Before, After } from '@cucumber/cucumber';

Before(async function () {
  this.browser = await puppeteer.launch({
    args: [
      '--disable-dev-shm-usage',
      '--no-sandbox'
    ]
  });
  this.page = await this.browser.newPage();
  await this.page.setViewport({ width: 1280, height: 720 });
});

After(async function () {
  await this.browser.close();
});
