import React from 'react';
import { BrowserRouter, Route, Routes } from 'react-router';
import Home from '../Home';
import { FeaturesProvider } from '../FeatureToggle';
import { NotFound } from '../Error';
import './App.sass';
import FeaturesEnum from '../FeatureToggle/FeaturesEnum';
import Join from '../Join';
import Confirm from '../Join/Confirm';
import Success from '../Join/Success';

type Props = {
  features: string[];
};

const App: React.FC<Props> = ({ features }) => {
  return (
    <FeaturesProvider features={features}>
      <BrowserRouter>
        <div className="App" data-testid="App">
          <div className="app">
            <Routes>
              <Route path="/" element={<Home />} />
              <Route path="*" element={<NotFound />} />
              {features.includes(FeaturesEnum.JoinToUs) ? (
                <Route path="/join" element={<Join />} />
              ) : null}
              {features.includes(FeaturesEnum.JoinToUs) ? (
                <Route path="/join/confirm" element={<Confirm />} />
              ) : null}
              {features.includes(FeaturesEnum.JoinToUs) ? (
                <Route path="/join/success" element={<Success />} />
              ) : null}
            </Routes>
          </div>
        </div>
      </BrowserRouter>
    </FeaturesProvider>
  );
};

export default App;
