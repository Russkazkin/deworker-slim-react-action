import React from 'react';
import styles from './Welcome.module.sass';
import FeatureFlag from '../FeatureToggle';

const Welcome: React.FC = () => {
  return (
    <div data-test="welcome" className={styles.welcome}>
      <h1>Auction</h1>
      <FeatureFlag not name="WE_ARE_HERE">
        <p>We will be here soon</p>
      </FeatureFlag>
      <FeatureFlag name="WE_ARE_HERE">
        <p>We are here</p>
      </FeatureFlag>
    </div>
  );
};

export default Welcome;
