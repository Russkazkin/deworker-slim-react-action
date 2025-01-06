import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import * as cookie from 'cookie';

const defaultFeatures: string[] = [];

const cookies = cookie.parse(document.cookie);
const cookieFeatures = (cookies.features || '').split(/\s*,\s*/g);

const features = [...defaultFeatures, ...cookieFeatures];

const root = ReactDOM.createRoot(document.getElementById('root') as HTMLElement);
root.render(
  <React.StrictMode>
    <App features={features} />
  </React.StrictMode>,
);
