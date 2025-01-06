import React from 'react';
import './App.sass';
import Welcome from '../Welcome';
import { FeaturesProvider } from "../FeatureToggle";

type Props = {
  features: string[];
};

const App: React.FC<Props> = ({ features }) => {
  return (
    <FeaturesProvider features={features}>
      <div className="App">
        <div className="app">
          <Welcome />
        </div>
      </div>
    </FeaturesProvider>
  );
};

export default App;
