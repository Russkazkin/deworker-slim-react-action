import React from 'react';
import styles from './Welcome.module.sass';
import FeatureFlag, { FeaturesEnum } from '../FeatureToggle';

const Welcome: React.FC = () => {
  return (
    <div data-testid="welcome" className={styles.welcome}>
      <h1>Auction</h1>
      <FeatureFlag not name={FeaturesEnum.WeAreHere}>
        <p>We will be here soon!</p>
      </FeatureFlag>
      <FeatureFlag name={FeaturesEnum.WeAreHere}>
        <p>We are here</p>
      </FeatureFlag>
    </div>
  );
};

export default Welcome;
