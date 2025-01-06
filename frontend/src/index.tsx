import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';

const features: string[] = [];

const root = ReactDOM.createRoot(document.getElementById('root') as HTMLElement);
root.render(
  <React.StrictMode>
    <App features={features} />
  </React.StrictMode>,
);
