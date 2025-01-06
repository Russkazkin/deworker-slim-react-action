import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import { FeaturesEnum } from "./FeatureToggle";

const features: string[] = [FeaturesEnum.WeAreHere];

const root = ReactDOM.createRoot(document.getElementById('root') as HTMLElement);
root.render(
  <React.StrictMode>
    <App features={features} />
  </React.StrictMode>,
);
