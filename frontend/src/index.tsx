import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import * as cookie from 'cookie';
import { mergeFeatures } from './FeatureToggle';
import defaultFeatures from './features';

const cookies = cookie.parse(document.cookie);
const cookieFeatures = (cookies.features || '').split(/\s*,\s*/g).filter(Boolean);

const features = mergeFeatures(defaultFeatures, cookieFeatures);

const root = ReactDOM.createRoot(document.getElementById('root') as HTMLElement);
root.render(
  <React.StrictMode>
    <App features={features} />
  </React.StrictMode>
);
