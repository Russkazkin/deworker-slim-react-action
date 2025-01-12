import React from 'react';
import './App.sass';
import Home from '../Home';
import { FeaturesProvider } from '../FeatureToggle';

type Props = {
  features: string[];
};

const App: React.FC<Props> = ({ features }) => {
  return (
    <FeaturesProvider features={features}>
      <div className="App" data-testid="App">
        <div className="app">
          <Home />
        </div>
      </div>
    </FeaturesProvider>
  );
};

export default App;
