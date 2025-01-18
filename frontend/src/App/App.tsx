import React from 'react';
import './App.sass';
import Home from '../Home';
import { FeaturesProvider } from '../FeatureToggle';
import { BrowserRouter, Route, Routes } from 'react-router';

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
            </Routes>
            <Home />
          </div>
        </div>
      </BrowserRouter>
    </FeaturesProvider>
  );
};

export default App;
