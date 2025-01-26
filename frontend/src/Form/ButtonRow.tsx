import React, { ReactNode } from 'react';

type Props = {
  children: ReactNode;
};

const ButtonRow: React.FC<Props> = ({ children }) => {
  return <div className="button-row">{children}</div>;
};

export default ButtonRow;
