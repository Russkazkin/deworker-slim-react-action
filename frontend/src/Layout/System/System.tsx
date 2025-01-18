import React from 'react';
import styles from './System.module.sass';

type Props = {
  children: React.ReactNode;
};

const System: React.FC<Props> = ({ children }) => {
  return (
    <>
      <div className={styles.layout}>
        <div className={styles.content}>{children}</div>
      </div>
    </>
  );
};

export default System;
