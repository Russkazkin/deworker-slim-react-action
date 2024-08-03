import puppeteer from 'puppeteer';
import { Before, After, Status } from '@cucumber/cucumber';

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

After(async function (testCase) {
  if (this.page) {
    if (testCase.result && testCase.result.status === Status.FAILED) {
      const screenShot = await this.page.screenshot({ fullPage: true });
      this.attach(screenShot, 'image/png');
    }
    await this.page.close();
  }
  if (this.browser) {
    await this.browser.close();
  }
});
